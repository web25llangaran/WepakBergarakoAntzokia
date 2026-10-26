<?php

namespace Database\Factories;

use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sarrera>
 */
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
            'id_user' => User::factory(),
            'data' => fake()->dateTimeBetween('-1 month', '+1 months'),
            'prezioa' => fake()->randomFloat(2, 5, 50),
        ];
    }
}
