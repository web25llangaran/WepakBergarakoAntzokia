<?php

namespace Database\Seeders;

use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Database\Seeder;

class SarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekitaldiak = Ekitaldia::all();
        $users = User::all();

        // Crear usuarios si la tabla está vacía
        if ($users->isEmpty()) {
            $users = User::factory(10)->create();
        }

        // Crear eventos si la tabla está vacía
        if ($ekitaldiak->isEmpty()) {
            $ekitaldiak = Ekitaldia::factory(3)->create();
        }

        foreach ($ekitaldiak as $ekitaldia) {
            // Ekitaldiari dagokion eserlekuak lortu:
            $eserlekuak = Eserlekua::where('id_aretoa', $ekitaldia->id_aretoa)->get();

            if ($eserlekuak->isNotEmpty()) {
                // eskatu zenbaki aleatorio bat saldutako sarrera gisa:
                $saldutakoEserlekuak = $eserlekuak->random(min(rand(3, 10), $eserlekuak->count()));

                foreach ($saldutakoEserlekuak as $eserlekua) {
                    Sarrera::create([
                        'id_ekitaldia' => $ekitaldia->id,
                        'id_aretoa'    => $ekitaldia->id_aretoa,
                        'id_eserlekua' => $eserlekua->id,
                        'id_user'      => $users->random()->id,
                        'data'         => now(),
                        'prezioa'      => rand(10, 30) + 0.50,
                    ]);
                }
            }
        }
    }
}