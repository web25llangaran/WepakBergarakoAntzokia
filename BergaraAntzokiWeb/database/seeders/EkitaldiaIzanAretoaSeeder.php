<?php

namespace Database\Seeders;


use App\Models\EkitaldiaIzanAretoa;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EkitaldiaIzanAretoaSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $ekitaldiak = Ekitaldia::all();
        $aretoak = Aretoa::all();

        // Aseguramos que existan eventos y salas cargados previamente
        if ($ekitaldiak->isEmpty()) {
            $this->call(EkitaldiaSeeder::class);
            $ekitaldiak = Ekitaldia::all();
        }

        if ($aretoak->isEmpty()) {
            $this->call(AretoaSeeder::class);
            $aretoak = Aretoa::all();
        }

        // Asignamos una o varias salas aleatorias a cada evento sin repetir la clave compuesta
        foreach ($ekitaldiak as $ekitaldia) {
            // Selecciona 1 o 2 salas aleatorias para este evento
            $salasAsignadas = $aretoak->random(min(rand(1, 2), $aretoak->count()));

            foreach ($salasAsignadas as $aretoa) {
                EkitaldiaIzanAretoa::factory()->create([
                    'id_ekitaldia' => $ekitaldia->id,
                    'id_aretoa' => $aretoa->id,
                ]);
            }
        }
    }
}
