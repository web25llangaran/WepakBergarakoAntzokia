<?php

namespace Database\Seeders;


use App\Models\Aretoa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Seeder de salas: crea las 2 salas del teatro (Areto Nagusia y Areto Txikia).
class AretoaSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Aretoa::factory(2)->create();

        // Sala grande: 200 butacas repartidas en 10 filas.
        Aretoa::create([
            'izena' => 'Areto Nagusia',
            'exerleku_kopurua' => 200,
            'lerro_kopurua' => 10,
        ]);

        // Sala pequeña: 50 butacas repartidas en 5 filas.
        Aretoa::create([
            'izena' => 'Areto Txikia',
            'exerleku_kopurua' => 50,
            'lerro_kopurua' => 5,
        ]);

    }
}