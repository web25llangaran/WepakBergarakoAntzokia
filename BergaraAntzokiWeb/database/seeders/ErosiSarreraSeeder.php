<?php

namespace Database\Seeders;


use App\Models\ErosiSarrera;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ErosiSarreraSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sarrerak = Sarrera::all();
        $erabiltzaileak = User::all();

        // Si no hay entradas o usuarios cargados, los aseguramos
        if ($erabiltzaileak->isEmpty()) {
            $erabiltzaileak = User::factory(5)->create();
        }

        if ($sarrerak->isEmpty()) {
            $this->call(SarreraSeeder::class);
            $sarrerak = Sarrera::all();
        }

        foreach ($sarrerak as $sarrera) {
            ErosiSarrera::factory()->create([
                'id_sarrera' => $sarrera->id,
                'id_user' => $erabiltzaileak->random()->id,
            ]);
        }
    }
}