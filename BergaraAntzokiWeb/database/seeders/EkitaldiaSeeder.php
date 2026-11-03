<?php

namespace Database\Seeders;


use App\Models\Ekitaldia;
use App\Models\Aretoa;
use App\Enums\EkitaldiMota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EkitaldiaSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ekitaldia::factory(4)->create();

        // $aretoak = Aretoa::all();

        // if ($aretoak->isEmpty()) {
        //     $aretoak = Aretoa::factory(3)->create();
        // }

        // foreach ($aretoak as $aretoa) {
        //     Ekitaldia::factory(2)->create([
        //         'id_aretoa' => $aretoa->id,
        //     ]);
        // }

        Ekitaldia::factory()->create([
            'izena' => 'Erresuma: Shakespeareren Tragediak',
            'deskripzioa' => 'Antzerki garaikidea. Benetan gomendatua',
            'ekitaldi_mota'=> EkitaldiMota::Antzezlana,
            'id_aretoa'=> '1',
            'data' => "2026-12-04 16:30:00",
            'irudia' => "",
        ]);
        Ekitaldia::factory()->create([
            'izena' => 'Hezten',
            'deskripzioa' => 'Familia berriak, hezkuntza etxean',
            'ekitaldi_mota'=> EkitaldiMota::Hitzaldia,    
            'id_aretoa'=> '2',
            'data' => "2026-12-01 17:30:00",
            'irudia' => "",
        ]);
        Ekitaldia::factory()->create([ 
            'izena' => '"Irati" (2022): Euskal Zinema ',
            'deskripzioa' => 'Euskal zinema.',
            'ekitaldi_mota'=> EkitaldiMota::Zinema,  
            'id_aretoa'=> '1', 
            'data' => "2026-12-03 16:30:00",
            'irudia' => "",
        ]);
        Ekitaldia::factory()->create([
            'izena' => 'Euskara: norena da?',
            'deskripzioa' => 'Euskarari buruzko hitzaldia',
            'ekitaldi_mota'=> EkitaldiMota::Hitzaldia,    
            'id_aretoa'=> '2',
            'data' => "2026-12-03 17:30:00",
            'irudia' => "",
        ]);
        Ekitaldia::factory()->create([
            'izena' => 'Izaro: Cerodenero',
            'deskripzioa' => 'Euskarari buruzko hitzaldia',
            'ekitaldi_mota'=> EkitaldiMota::Kontzertua,    
            'id_aretoa'=> '1',
            'data' => "2026-12-03 19:30:00",
            'irudia' => "",
        ]);

    }
}
