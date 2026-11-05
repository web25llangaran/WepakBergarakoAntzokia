<?php

use App\Enums\Rola;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;

beforeEach(function () {
    $this->admin = User::factory()->create(['rola' => Rola::Admin->value]);
    $this->aretoa = Aretoa::factory()->create();
    $this->ekitaldia = Ekitaldia::factory()->for($this->aretoa, 'aretoa')->create();
    $this->eserlekua = Eserlekua::factory()->for($this->aretoa, 'aretoa')->create();
    $this->eroslea = User::factory()->create();
});

/**
 * @return array{id_user: int, id_ekitaldia: int, id_eserlekua: int, prezioa: float}
 */
function sarreraDatuak(object $test, array $aldaketak = []): array
{
    return [
        'id_user' => $test->eroslea->id,
        'id_ekitaldia' => $test->ekitaldia->id,
        'id_eserlekua' => $test->eserlekua->id,
        'prezioa' => 12.5,
        ...$aldaketak,
    ];
}

test('admin can create a sarrera', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.sarrera.store'), sarreraDatuak($this))
        ->assertRedirect(route('admin.dashboard').'#sarrerak')
        ->assertSessionHas('success');

    $this->assertDatabaseHas('sarrerak', [
        'id_user' => $this->eroslea->id,
        'id_ekitaldia' => $this->ekitaldia->id,
        'id_eserlekua' => $this->eserlekua->id,
        'prezioa' => 12.5,
    ]);
});

test('dashboard, create, show and edit pages render', function () {
    $sarrera = Sarrera::factory()->create(sarreraDatuak($this));

    $this->actingAs($this->admin);
    $this->get(route('admin.dashboard'))->assertOk()->assertSee(route('admin.sarrera.edit', $sarrera));
    $this->get(route('admin.sarrera.sortu'))->assertOk();
    $this->get(route('admin.sarrera.show', $sarrera))->assertOk()->assertSee($this->ekitaldia->izena);
    $this->get(route('admin.sarrera.edit', $sarrera))->assertOk();
});

test('form pages show the admin sidebar with the sarrerak tab active', function () {
    $sarrera = Sarrera::factory()->create(sarreraDatuak($this));

    $this->actingAs($this->admin);

    foreach ([route('admin.sarrera.sortu'), route('admin.sarrera.show', $sarrera), route('admin.sarrera.edit', $sarrera)] as $url) {
        $this->get($url)
            ->assertOk()
            ->assertSee('id="v-pills-tab"', false)
            ->assertSee('href="'.route('admin.dashboard').'#ekitaldiak"', false)
            ->assertSee('action="'.route('logout').'"', false)
            ->assertSeeInOrder(['id="v-pills-sarrerak-tab"', 'nav-link text-white text-start active', 'Saldutako sarrerak'], false);
    }
});

test('a seat cannot be sold twice for the same ekitaldia', function () {
    Sarrera::factory()->create(sarreraDatuak($this));

    $this->actingAs($this->admin)
        ->post(route('admin.sarrera.store'), sarreraDatuak($this))
        ->assertSessionHasErrors('id_eserlekua');

    expect(Sarrera::count())->toBe(1);
});

test('the database rejects a duplicated seat for the same ekitaldia', function () {
    Sarrera::factory()->create(sarreraDatuak($this));

    Sarrera::factory()->create(sarreraDatuak($this));
})->throws(UniqueConstraintViolationException::class);

test('the seat must belong to the aretoa of the ekitaldia', function () {
    $besteAretokoEserlekua = Eserlekua::factory()->create();

    $this->actingAs($this->admin)
        ->post(route('admin.sarrera.store'), sarreraDatuak($this, ['id_eserlekua' => $besteAretokoEserlekua->id]))
        ->assertSessionHasErrors('id_eserlekua');

    expect(Sarrera::count())->toBe(0);
});

test('invalid data is rejected', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.sarrera.store'), ['prezioa' => -5])
        ->assertSessionHasErrors(['id_user', 'id_ekitaldia', 'id_eserlekua', 'prezioa']);
});

test('admin can update a sarrera keeping its own seat', function () {
    $sarrera = Sarrera::factory()->create(sarreraDatuak($this));

    $this->actingAs($this->admin)
        ->put(route('admin.sarrera.update', $sarrera), sarreraDatuak($this, ['prezioa' => 20]))
        ->assertRedirect(route('admin.dashboard').'#sarrerak')
        ->assertSessionHasNoErrors();

    expect($sarrera->fresh()->prezioa)->toBe('20.00');
});

test('admin can delete a sarrera', function () {
    $sarrera = Sarrera::factory()->create(sarreraDatuak($this));

    $this->actingAs($this->admin)
        ->delete(route('admin.sarrera.destroy', $sarrera))
        ->assertRedirect(route('admin.dashboard').'#sarrerak');

    $this->assertModelMissing($sarrera);
});

test('non admin users cannot manage sarrerak', function () {
    $sarrera = Sarrera::factory()->create(sarreraDatuak($this));

    $this->actingAs($this->eroslea);
    $this->get(route('admin.sarrera.sortu'))->assertForbidden();
    $this->post(route('admin.sarrera.store'), sarreraDatuak($this))->assertForbidden();
    $this->put(route('admin.sarrera.update', $sarrera), sarreraDatuak($this))->assertForbidden();
    $this->delete(route('admin.sarrera.destroy', $sarrera))->assertForbidden();

    $this->assertModelExists($sarrera);
});
