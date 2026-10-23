<?php

namespace Database\Factories;

use App\Models\Ekitaldia;
use App\Enums\EkitaldiMota;
use Illuminate\Database\Eloquent\Factories\Factory;

class EkitaldiaFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'izena' => fake()->word(),
            'deskripzioa' => fake()->text(200),
            'ekitaldi_mota'=> EkitaldiMota::Zinema,
            'data' => fake()->dateTimeBetween('now', '+3 months'), // Genera eventos entre hoy y los próximos 3 meses
            'irudia' => 'images/ekitaldiak/' . fake()->word() . '.jpg', // O puedes usar fake()->imageUrl(640, 480, 'events')
        ];
    }
}
