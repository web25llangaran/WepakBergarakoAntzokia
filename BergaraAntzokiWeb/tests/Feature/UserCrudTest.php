<?php

use App\Enums\Rola;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->admin = User::factory()->create(['rola' => Rola::Admin->value]);
});

/**
 * @return array<string, string|null>
 */
function erabiltzaileDatuak(array $aldaketak = []): array
{
    return [
        'user_izena' => 'mgarai',
        'izena' => 'Miren',
        'abizena' => 'Garai',
        'email' => 'miren@example.com',
        'nan' => '12345678Z',
        'rola' => Rola::Arrunta->value,
        'password' => 'pasahitza123',
        'password_confirmation' => 'pasahitza123',
        'baja_data' => null,
        ...$aldaketak,
    ];
}

test('admin can create a user with a hashed password and alta_data', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.erabiltzailea.store'), erabiltzaileDatuak())
        ->assertRedirect(route('admin.dashboard').'#erabiltzaileak')
        ->assertSessionHas('success');

    $erabiltzailea = User::firstWhere('user_izena', 'mgarai');

    expect($erabiltzailea)->not->toBeNull()
        ->and($erabiltzailea->rola)->toBe(Rola::Arrunta->value)
        ->and($erabiltzailea->alta_data)->not->toBeNull()
        ->and(Hash::check('pasahitza123', $erabiltzailea->password))->toBeTrue();
});

test('dashboard, create, show and edit pages render', function () {
    $erabiltzailea = User::factory()->create();
    Sarrera::factory()->for($erabiltzailea, 'eroslea')->create();

    $this->actingAs($this->admin);
    $this->get(route('admin.dashboard'))->assertOk()->assertSee(route('admin.erabiltzailea.edit', $erabiltzailea));
    $this->get(route('admin.erabiltzailea.sortu'))->assertOk();
    $this->get(route('admin.erabiltzailea.show', $erabiltzailea))->assertOk()->assertSee($erabiltzailea->email);
    $this->get(route('admin.erabiltzailea.edit', $erabiltzailea))->assertOk();
});

test('invalid or duplicated data is rejected', function () {
    $lehendikDagoena = User::factory()->create();

    $this->actingAs($this->admin)
        ->post(route('admin.erabiltzailea.store'), erabiltzaileDatuak([
            'user_izena' => $lehendikDagoena->user_izena,
            'email' => $lehendikDagoena->email,
            'nan' => '123',
            'rola' => 'superadmin',
            'password_confirmation' => 'besteBat123',
        ]))
        ->assertSessionHasErrors(['user_izena', 'email', 'nan', 'rola', 'password']);

    expect(User::count())->toBe(2);
});

test('admin can update a user keeping the password when left empty', function () {
    $erabiltzailea = User::factory()->create();
    $pasahitzZaharra = $erabiltzailea->password;

    $this->actingAs($this->admin)
        ->put(route('admin.erabiltzailea.update', $erabiltzailea), erabiltzaileDatuak([
            'user_izena' => $erabiltzailea->user_izena,
            'email' => $erabiltzailea->email,
            'izena' => 'Izen Berria',
            'password' => '',
            'password_confirmation' => '',
        ]))
        ->assertRedirect(route('admin.dashboard').'#erabiltzaileak')
        ->assertSessionHasNoErrors();

    $erabiltzailea->refresh();
    expect($erabiltzailea->izena)->toBe('Izen Berria')
        ->and($erabiltzailea->password)->toBe($pasahitzZaharra);
});

test('the role cannot be changed when updating a user', function () {
    $arrunta = User::factory()->create();

    $this->actingAs($this->admin)
        ->put(route('admin.erabiltzailea.update', $arrunta), erabiltzaileDatuak([
            'user_izena' => $arrunta->user_izena,
            'email' => $arrunta->email,
            'rola' => Rola::Admin->value,
            'password' => '',
            'password_confirmation' => '',
        ]))
        ->assertSessionHasNoErrors();

    $this->actingAs($this->admin)
        ->put(route('admin.erabiltzailea.update', $this->admin), erabiltzaileDatuak([
            'user_izena' => $this->admin->user_izena,
            'email' => $this->admin->email,
            'nan' => null,
            'rola' => Rola::Arrunta->value,
            'password' => '',
            'password_confirmation' => '',
        ]))
        ->assertSessionHasNoErrors();

    expect($arrunta->fresh()->rola)->toBe(Rola::Arrunta->value)
        ->and($this->admin->fresh()->rola)->toBe(Rola::Admin->value);
});

test('the edit form shows the role as read only', function () {
    $arrunta = User::factory()->create();

    $this->actingAs($this->admin)
        ->get(route('admin.erabiltzailea.edit', $arrunta))
        ->assertOk()
        ->assertDontSee('name="rola"', false)
        ->assertSee('Rola ezin da aldatu.');
});

test('admin can delete a user and their sarrerak', function () {
    $erabiltzailea = User::factory()->create();
    $sarrera = Sarrera::factory()->for($erabiltzailea, 'eroslea')->create();

    $this->actingAs($this->admin)
        ->delete(route('admin.erabiltzailea.destroy', $erabiltzailea))
        ->assertRedirect(route('admin.dashboard').'#erabiltzaileak');

    $this->assertModelMissing($erabiltzailea);
    $this->assertModelMissing($sarrera);
});

test('admin cannot delete themselves', function () {
    $this->actingAs($this->admin)
        ->delete(route('admin.erabiltzailea.destroy', $this->admin))
        ->assertSessionHas('error');

    $this->assertModelExists($this->admin);
});

test('non admin users cannot manage users', function () {
    $arrunta = User::factory()->create();
    $bestea = User::factory()->create();

    $this->actingAs($arrunta);
    $this->get(route('admin.erabiltzailea.sortu'))->assertForbidden();
    $this->post(route('admin.erabiltzailea.store'), erabiltzaileDatuak())->assertForbidden();
    $this->put(route('admin.erabiltzailea.update', $bestea), erabiltzaileDatuak())->assertForbidden();
    $this->delete(route('admin.erabiltzailea.destroy', $bestea))->assertForbidden();

    $this->assertModelExists($bestea);
});
