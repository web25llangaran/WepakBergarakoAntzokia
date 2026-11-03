<?php

namespace Database\Seeders;


use App\Models\Aretoa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AretoaSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Aretoa::factory(2)->create();

        Aretoa::create([
            'izena' => 'Areto Nagusia',
            'exerleku_kopurua' => 200,
            'lerro_kopurua' => 10,
        ]);

        Aretoa::create([
            'izena' => 'Areto Txikia',
            'exerleku_kopurua' => 50,
            'lerro_kopurua' => 5,
        ]);

    }
}