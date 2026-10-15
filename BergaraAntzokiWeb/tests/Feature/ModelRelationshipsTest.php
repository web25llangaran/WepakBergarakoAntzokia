<?php

use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekuak;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('models resolve their tables and pivot relationships', function () {
    $aretoa = Aretoa::create([
        'izena' => 'Areto nagusia',
        'exerleku_kopurua' => 100,
        'lerro_kopurua' => 10,
    ]);

    $ekitaldia = Ekitaldia::create([
        'izena' => 'Kontzertua',
        'deskripzioa' => null,
        'mota' => 'kontzertua',
        'data' => now(),
    ]);

    $eserlekua = Eserlekuak::create([
        'id_aretoa' => $aretoa->id,
        'lerro_zenb' => 1,
        'exerleku_zenb' => 1,
        'mota' => 'arrunta',
    ]);

    $sarrera = Sarrera::create([
        'id_ekitaldia' => $ekitaldia->id,
        'id_aretoa' => $aretoa->id,
        'id_eserlekua' => $eserlekua->id,
        'data' => now(),
        'prezioa' => 12.50,
    ]);

    $user = User::create([
        'user_izena' => 'ikusle1',
        'email' => 'ikusle@example.com',
        'password' => 'password',
        'alta_data' => now(),
        'izena' => 'Ane',
        'abizena' => 'Etxeberria',
    ]);

    $ekitaldia->aretoak()->attach($aretoa);
    $ekitaldia->kudeatzaileak()->attach($user);
    $ekitaldia->ikusleak()->attach($user);
    $sarrera->kudeatzaileak()->attach($user);
    $sarrera->erosleak()->attach($user);

    expect($ekitaldia->aretoak->modelKeys())->toBe([$aretoa->id])
        ->and($aretoa->ekitaldiak->modelKeys())->toBe([$ekitaldia->id])
        ->and($ekitaldia->kudeatzaileak->modelKeys())->toBe([$user->id])
        ->and($user->kudeatutakoEkitaldiak->modelKeys())->toBe([$ekitaldia->id])
        ->and($ekitaldia->ikusleak->modelKeys())->toBe([$user->id])
        ->and($user->ikusitakoEkitaldiak->modelKeys())->toBe([$ekitaldia->id])
        ->and($sarrera->kudeatzaileak->modelKeys())->toBe([$user->id])
        ->and($user->kudeatutakoSarrerak->modelKeys())->toBe([$sarrera->id])
        ->and($sarrera->erosleak->modelKeys())->toBe([$user->id])
        ->and($user->erositakoSarrerak->modelKeys())->toBe([$sarrera->id])
        ->and($sarrera->ekitaldia->is($ekitaldia))->toBeTrue()
        ->and($sarrera->aretoa->is($aretoa))->toBeTrue()
        ->and($sarrera->eserlekua->is($eserlekua))->toBeTrue()
        ->and($eserlekua->aretoa->is($aretoa))->toBeTrue();
});
