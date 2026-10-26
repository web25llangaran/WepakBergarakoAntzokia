<?php

namespace Database\Seeders;

use App\Enums\EserlekuMota;
use App\Models\Aretoa;
use App\Models\Eserlekua;
use Illuminate\Database\Seeder;

class EserlekuaSeeder extends Seeder
{
    public function run(): void
    {
        $aretoak = Aretoa::all();

        if ($aretoak->isEmpty()) {
            $aretoak = Aretoa::factory(2)->create();
        }

        foreach ($aretoak as $aretoa) {
            $lerroKopurua = $aretoa->lerro_kopurua ?? 5;
            $totalEserlekuak = $aretoa->eserleku_kopurua ?? 50;

            // Eserlekuak lerroko:
            $eserlekuakLerroko = (int) ceil($totalEserlekuak / $lerroKopurua);

            for ($asiento = 1; $asiento <= $eserlekuakLerroko; $asiento++) {
                Eserlekua::create([
                    'id_aretoa' => $aretoa->id,
                    'lerro_zenb' => "1",
                    'eserleku_zenb' => $asiento,
                    'eserleku_mota' => EserlekuMota::Silver_economy,
                ]);
            }

            for ($fila = 2; $fila <= $lerroKopurua; $fila++) {
                for ($asiento = 1; $asiento <= $eserlekuakLerroko; $asiento++) {
                    Eserlekua::create([
                        'id_aretoa' => $aretoa->id,
                        'lerro_zenb' => $fila,
                        'eserleku_zenb' => $asiento,
                        'eserleku_mota' => EserlekuMota::Arrunta,
                    ]);
                }
            }
        }
    }
}
