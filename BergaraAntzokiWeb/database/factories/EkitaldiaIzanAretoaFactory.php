<?php

namespace Database\Factories;

use App\Models\EkitaldiaIzanAretoa;
use App\Models\Ekitaldia;
use App\Models\Aretoa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EkitaldiaIzanAretoaFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'id_ekitaldia' => Ekitaldia::factory(),
            'id_aretoa' => Aretoa::factory(),
        ];
    }
}
