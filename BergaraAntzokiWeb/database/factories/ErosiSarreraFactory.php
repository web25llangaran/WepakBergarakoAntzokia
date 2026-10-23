<?php

namespace Database\Factories;

use App\Models\ErosiSarrera;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ErosiSarreraFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'id_sarrera' => Sarrera::factory(),
            'id_user' => User::factory(),
        ];
    }
}
