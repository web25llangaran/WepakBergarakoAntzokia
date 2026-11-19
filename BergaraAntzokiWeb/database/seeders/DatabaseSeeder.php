<?php

namespace Database\Seeders;

use App\Enums\Rola;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Seeder principal: es el que se ejecuta con "php artisan db:seed" y rellena la BD con datos de prueba.
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(6)->create();

        // Creamos el usuario administrador (rol admin).
        User::factory()->create([
            'izena' => 'Admin',
            'abizena' => 'Erabiltzailea',
            'user_izena' => 'admin',
            'email' => 'admin@gmail.com',
            'nan' => null,
            'rola' => Rola::Admin,
        ]);
        // Creamos varios usuarios normales (rol arrunta por defecto) para poder probar compras.
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
        // Llamamos al resto de seeders en orden: salas -> butacas -> eventos -> entradas (cada uno necesita el anterior).
        $this->call([
            AretoaSeeder::class,
            EserlekuaSeeder::class,
            EkitaldiaSeeder::class,
            SarreraSeeder::class,
        ]);
    }
}
