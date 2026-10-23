<?php

namespace Database\Seeders;


use App\Models\Aretoa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AretoaSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Aretoa::factory(2)->create();

        Aretoa::factory()->create([
            'izena' => 'Udalatx',
            'exerleku_kopurua' => '80',
            'lerro_kopurua' => '8',        
        ]);
        Aretoa::factory()->create([
            'izena' => 'Anboto',
            'exerleku_kopurua' => '180',
            'lerro_kopurua' => '18',        
        ]);
        Aretoa::factory()->create([
            'izena' => 'Kurtzebarri',
            'exerleku_kopurua' => '120',
            'lerro_kopurua' => '12',        
        ]);
    }
}
