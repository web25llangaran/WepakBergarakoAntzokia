<?php

namespace Database\Seeders;

use App\Enums\EserlekuMota;
use App\Models\Aretoa;
use App\Models\Eserlekua;
use Illuminate\Database\Seeder;

class EserlekuaSeeder extends Seeder
{
    public function run(): void
    {
        $aretoak = Aretoa::all();

        if ($aretoak->isEmpty()) {
            $aretoak = Aretoa::factory(2)->create();
        }

        foreach ($aretoak as $aretoa) {
            $lerroak = 5;
            $eserlekuLerroko = 10;

            if ($aretoa->id != 3) {
                for ($lerroa = 1; $lerroa <= $lerroak; $lerroa++) {
                    for ($eserlekua = 2; $eserlekua <= $eserlekuLerroko; $eserlekua++) {
                        Eserlekua::factory()->create([
                            'id_aretoa' => $aretoa->id,
                            'lerro_zenb' => $lerroa,
                            'eserleku_zenb' => $eserlekua,
                        ]);
                    }
                }
            }
        }

        for ($eserleku_zenb = 1; $eserleku_zenb <= 10; $eserleku_zenb++) {
            Eserlekua::factory()->create([
                'id_aretoa' => "3",
                'lerro_zenb' => "1",
                'eserleku_zenb' => $eserleku_zenb,
                'eserleku_mota' => EserlekuMota::Silver_economy,
            ]);
        }
    }
}
