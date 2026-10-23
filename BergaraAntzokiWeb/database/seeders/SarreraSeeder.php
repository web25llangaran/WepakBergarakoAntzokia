<?php

namespace Database\Seeders;


use App\Models\Sarrera;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SarreraSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $ekitaldiak = Ekitaldia::all();
        $eserlekuak = Eserlekua::all();

        // Si no existen registros previo en las tablas relacionadas, los creamos
        if ($ekitaldiak->isEmpty()) {
            $ekitaldiak = Ekitaldia::factory(3)->create();
        }

        if ($eserlekuak->isEmpty()) {
            $this->call(EserlekuaSeeder::class);
            $eserlekuak = Eserlekua::all();
        }

        // Generamos entradas para cada evento vendiendo varios asientos
        foreach ($ekitaldiak as $ekitaldia) {
            // Selecciona hasta 10 asientos aleatorios existentes
            $asientosVendidos = $eserlekuak->random(min(10, $eserlekuak->count()));

            foreach ($asientosVendidos as $eserlekua) {
                Sarrera::factory()->create([
                    'id_ekitaldia' => $ekitaldia->id,
                    'id_aretoa' => $eserlekua->id_aretoa, // Coincide con la sala del asiento
                    'id_eserlekua' => $eserlekua->id,
                ]);
            }
        }
    }
}
