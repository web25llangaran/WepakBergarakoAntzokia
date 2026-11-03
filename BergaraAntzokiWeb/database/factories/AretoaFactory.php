<?php

namespace Database\Factories;

use App\Models\Aretoa;
use Illuminate\Database\Eloquent\Factories\Factory;

class AretoaFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'izena' => fake()->unique()->word(),
            'exerleku_kopurua' => fake()->numberBetween(1,200),
            'lerro_kopurua' => fake()->unique()->numberBetween(1,20),
        ];
    }
}