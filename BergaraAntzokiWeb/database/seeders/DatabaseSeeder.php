<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(6)->create();

        User::factory()->create([
            // users taula aldatu da, beraz hau be aldatu ein biher da:
            // Hemen, goian sortzen diren 6 usuario arruntez gain admin usuario sortuko da:
            'izena' => 'Admin',
            'abizena' => 'Erabiltzailea',
            'user_izena' => 'admin',
            'email' => 'admin@gmail.com',  
            'nan' => null,
            'rola' => 'admin',          
        ]);
        User::factory()->create([
            // users taula aldatu da, beraz hau be aldatu ein biher da:
            // Hemen, goian sortzen diren 6 usuario arruntez gain arrunta usuario sortuko da:
            'izena' => 'Arrunta',
            'abizena' => 'Erabiltzailea',
            'user_izena' => 'arrunta',
            'email' => 'arrunta@gmail.com',         
        ]);
    }
}
