<?php

namespace Database\Seeders;

use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\Rola;

class SarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekitaldiak = Ekitaldia::all();
        // User arruntek bakarrik erosi dezakete sarrerak: 
        $users = User::all();       
        $erabiltzaileak = $users->where('rola', '!=', Rola::Admin->value);

        foreach ($ekitaldiak as $ekitaldia) {
            // Ekitaldiari dagokion eserlekuak lortu:
            $eserlekuak = Eserlekua::where('id_aretoa', $ekitaldia->id_aretoa)->get();

            if ($eserlekuak->isNotEmpty()) {
                // eskatu zenbaki aleatorio bat saldutako sarrera gisa:
                $saldutakoEserlekuak = $eserlekuak->random(min(rand(3, 10), $eserlekuak->count()));

                foreach ($saldutakoEserlekuak as $eserlekua) {
                    Sarrera::create([
                        'id_ekitaldia' => $ekitaldia->id,
                        // 'id_aretoa'    => $ekitaldia->id_aretoa,
                        'id_eserlekua' => $eserlekua->id,
                        'id_user'      => $erabiltzaileak->random()->id,
                        // 'data'         => $ekitaldia->data,
                        'prezioa'      => $ekitaldia->id + 20,
                    ]);
                }
            }
        }
    }
}