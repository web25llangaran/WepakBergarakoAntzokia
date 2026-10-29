<?php

namespace Database\Seeders;

use App\Enums\Rola;
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
        // User::factory(6)->create();

        User::factory()->create([
            'izena' => 'Admin',
            'abizena' => 'Erabiltzailea',
            'user_izena' => 'admin',
            'email' => 'admin@gmail.com',
            'nan' => null,
            'rola' => Rola::Admin,
        ]);
        User::factory()->create([
            'izena' => 'Arrunta',
            'abizena' => 'Erabiltzailea',
            'user_izena' => 'arrunta',
            'email' => 'arrunta@gmail.com',
        ]);

         User::factory()->create([
            'izena' => 'Lide',
            'abizena' => 'Errasti',
            'user_izena' => 'lerrasti',
            'email' => 'lide@gmail.com',
        ]);
         User::factory()->create([
            'izena' => 'Jon',
            'abizena' => 'Goiko',
            'user_izena' => 'jgoiko',
            'email' => 'goiko@gmail.com',
        ]);
         User::factory()->create([
            'izena' => 'Ander',
            'abizena' => 'Etxabe',
            'user_izena' => 'aetxabe',
            'email' => 'ander@gmail.com',
        ]);
        $this->call([
            AretoaSeeder::class,
            EserlekuaSeeder::class,
            EkitaldiaSeeder::class,
            SarreraSeeder::class,
        ]);
    }
}
