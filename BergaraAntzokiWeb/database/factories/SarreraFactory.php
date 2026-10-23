<?php

namespace Database\Factories;

use App\Models\Sarrera;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use Illuminate\Database\Eloquent\Factories\Factory;

class SarreraFactory extends Factory
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
            'id_eserlekua' => Eserlekua::factory(),
            'data' => fake()->dateTimeBetween('-1 month', '+3 months'), // Fecha de compra de la entrada
            'prezioa' => fake()->randomFloat(2, 5, 35),
        ];
    }
}
