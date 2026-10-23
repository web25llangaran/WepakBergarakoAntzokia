<?php

namespace Database\Seeders;


use App\Models\Ekitaldia;
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
        Ekitaldia::factory(4)->create();

        Ekitaldia::factory()->create([
            'izena' => 'Behiak',
            'deskripzioa' => 'Antzerki garaikidea. Benetan gomendatua',
            'ekitaldi_mota'=> EkitaldiMota::Antzezlana,  
        ]);
        Ekitaldia::factory()->create([
            'izena' => 'Hezten',
            'deskripzioa' => 'Familia berriak, hezkuntza etxean',
            'ekitaldi_mota'=> EkitaldiMota::Hitzaldia,    
        ]);
        Ekitaldia::factory()->create([ 
            'izena' => 'Autoak. Zein erosi?',
            'deskripzioa' => 'Teknologia izugarri aldatu da. Zer izan behar da kontuan auto berri bat erosterakoan?',
            'ekitaldi_mota'=> EkitaldiMota::Hitzaldia,    
        ]);
    }
}
