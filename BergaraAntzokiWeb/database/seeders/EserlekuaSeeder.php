<?php

namespace Database\Seeders;

use App\Enums\EserlekuMota;
use App\Models\Aretoa;
use App\Models\Eserlekua;
use Illuminate\Database\Seeder;

// Seeder de butacas: genera automáticamente todas las butacas de cada sala (filas x butacas por fila).
class EserlekuaSeeder extends Seeder
{
    public function run(): void
    {
        // Cogemos todas las salas (si no hay ninguna, crea 2 de prueba con la factory).
        $aretoak = Aretoa::all();

        if ($aretoak->isEmpty()) {
            $aretoak = Aretoa::factory(2)->create();
        }

        // Por cada sala calculamos cuántas filas tiene y cuántas butacas hay en cada fila.
        foreach ($aretoak as $aretoa) {
            $lerroKopurua = $aretoa->lerro_kopurua ?? 5;
            $totalEserlekuak = $aretoa->exerleku_kopurua ?? 50;

            // Eserlekuak lerroko:
            $eserlekuakLerroko = (int) ceil($totalEserlekuak / $lerroKopurua);

            // firstOrCreate: eserlekua jada existitzen bada ez da berriz sortzen, falta direnak bakarrik gehitzen dira.
            for ($asiento = 1; $asiento <= $eserlekuakLerroko; $asiento++) {
                Eserlekua::firstOrCreate(
                    ['id_aretoa' => $aretoa->id, 'lerro_zenb' => 1, 'eserleku_zenb' => $asiento],
                    ['eserleku_mota' => EserlekuMota::Silver_economy],
                );
            }

            // El resto de filas (de la 2 en adelante) son butacas normales.
            for ($fila = 2; $fila <= $lerroKopurua; $fila++) {
                for ($asiento = 1; $asiento <= $eserlekuakLerroko; $asiento++) {
                    Eserlekua::firstOrCreate(
                        ['id_aretoa' => $aretoa->id, 'lerro_zenb' => $fila, 'eserleku_zenb' => $asiento],
                        ['eserleku_mota' => EserlekuMota::Arrunta],
                    );
                }
            }
        }
    }
}
