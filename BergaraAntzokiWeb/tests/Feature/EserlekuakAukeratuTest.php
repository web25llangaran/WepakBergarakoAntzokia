<?php

use App\Enums\EserlekuMota;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use App\Models\User;

beforeEach(function () {
    $this->withoutVite();

    $this->aretoa = Aretoa::factory()->create();
    $this->ekitaldia = Ekitaldia::factory()->for($this->aretoa, 'aretoa')->create();
    $this->silverEserlekua = Eserlekua::factory()->for($this->aretoa, 'aretoa')->create([
        'lerro_zenb' => 1,
        'eserleku_zenb' => 1,
        'eserleku_mota' => EserlekuMota::Silver_economy,
    ]);
    $this->libreEserlekua = Eserlekua::factory()->for($this->aretoa, 'aretoa')->create([
        'lerro_zenb' => 2,
        'eserleku_zenb' => 1,
        'eserleku_mota' => EserlekuMota::Arrunta,
    ]);
    $this->okupatutakoEserlekua = Eserlekua::factory()->for($this->aretoa, 'aretoa')->create([
        'lerro_zenb' => 2,
        'eserleku_zenb' => 2,
        'eserleku_mota' => EserlekuMota::Arrunta,
    ]);
    $this->erabiltzailea = User::factory()->create();
});

test('guest is redirected to login from the seat selection page', function () {
    $this->get(route('ekitaldiak.eserlekuak', $this->ekitaldia))
        ->assertRedirect(route('login'));
});

test('event info page links to the seat selection page', function () {
    $this->get(route('ekitaldiak.show', $this->ekitaldia))
        ->assertOk()
        ->assertSee(route('ekitaldiak.eserlekuak', $this->ekitaldia), false);
});

test('seat page shows every seat of the hall and marks sold seats as booked', function () {
    Sarrera::factory()->create([
        'id_ekitaldia' => $this->ekitaldia->id,
        'id_eserlekua' => $this->okupatutakoEserlekua->id,
        'id_user' => User::factory()->create()->id,
        'prezioa' => 25,
    ]);

    $this->actingAs($this->erabiltzailea)
        ->get(route('ekitaldiak.eserlekuak', $this->ekitaldia))
        ->assertOk()
        ->assertSee('1. ilara, 1. eserlekua, Silver Economy', false)
        ->assertSeeInOrder(['data-id="'.$this->libreEserlekua->id.'"', 'seat  ', 'data-id="'.$this->okupatutakoEserlekua->id.'"'], false)
        ->assertSee('seat  booked', false);
});

test('seat page ignores seats that are sold for a different event', function () {
    $besteEkitaldia = Ekitaldia::factory()->for($this->aretoa, 'aretoa')->create();
    Sarrera::factory()->create([
        'id_ekitaldia' => $besteEkitaldia->id,
        'id_eserlekua' => $this->libreEserlekua->id,
        'id_user' => User::factory()->create()->id,
    ]);

    $this->actingAs($this->erabiltzailea)
        ->get(route('ekitaldiak.eserlekuak', $this->ekitaldia))
        ->assertOk()
        ->assertDontSee('seat  booked', false);
});

test('silver economy seats are cheaper than regular seats', function () {
    Sarrera::factory()->create([
        'id_ekitaldia' => $this->ekitaldia->id,
        'id_eserlekua' => $this->okupatutakoEserlekua->id,
        'id_user' => User::factory()->create()->id,
        'prezioa' => 22,
    ]);

    $this->actingAs($this->erabiltzailea)
        ->get(route('ekitaldiak.eserlekuak', $this->ekitaldia))
        ->assertViewHas('prezioa', 22.0)
        ->assertViewHas('silverPrezioa', 12.0);
});

test('the price comes from the tickets of the chosen event only', function () {
    $besteEkitaldia = Ekitaldia::factory()->for($this->aretoa, 'aretoa')->create();
    Sarrera::factory()->create([
        'id_ekitaldia' => $besteEkitaldia->id,
        'id_eserlekua' => $this->libreEserlekua->id,
        'id_user' => User::factory()->create()->id,
        'prezioa' => 30,
    ]);
    Sarrera::factory()->create([
        'id_ekitaldia' => $this->ekitaldia->id,
        'id_eserlekua' => $this->okupatutakoEserlekua->id,
        'id_user' => User::factory()->create()->id,
        'prezioa' => 22,
    ]);

    $this->actingAs($this->erabiltzailea)
        ->get(route('ekitaldiak.eserlekuak', $this->ekitaldia))
        ->assertViewHas('prezioa', 22.0);
});

test('event info page shows the event data and its price', function () {
    Sarrera::factory()->create([
        'id_ekitaldia' => $this->ekitaldia->id,
        'id_eserlekua' => $this->okupatutakoEserlekua->id,
        'id_user' => User::factory()->create()->id,
        'prezioa' => 22,
    ]);

    $this->get(route('ekitaldiak.show', $this->ekitaldia))
        ->assertOk()
        ->assertSee($this->ekitaldia->izena)
        ->assertSee('22,00€-tik', false);
});

test('the seeder creates every seat defined by the hall and does not duplicate them', function () {
    $aretoNagusia = Aretoa::factory()->create(['exerleku_kopurua' => 200, 'lerro_kopurua' => 10]);

    $this->seed(EserlekuaSeeder::class);
    $this->seed(EserlekuaSeeder::class);

    expect(Eserlekua::where('id_aretoa', $aretoNagusia->id)->count())->toBe(200)
        ->and(Eserlekua::where('id_aretoa', $aretoNagusia->id)->where('lerro_zenb', 1)->where('eserleku_mota', EserlekuMota::Silver_economy->value)->count())->toBe(20)
        ->and(Eserlekua::where('id_aretoa', $aretoNagusia->id)->where('lerro_zenb', 10)->count())->toBe(20);
});
