<?php

namespace Database\Factories;

use App\Enums\EserlekuMota;
use App\Models\Eserlekua;
use App\Models\Aretoa;
use Illuminate\Database\Eloquent\Factories\Factory;

class EserlekuaFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'id_aretoa' => Aretoa::factory(),
            'lerro_zenb' => fake()->numberBetween(1,8),
            'eserleku_zenb' => fake()->numberBetween(1,80),
            'eserleku_mota' => EserlekuMota::Arrunta,
        ];
    }
}