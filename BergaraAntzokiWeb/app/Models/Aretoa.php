<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Modelo de la tabla "aretoak" (salas del teatro). Representa una sala y sus relaciones.
class Aretoa extends Model
{
    use HasFactory;
    protected $table = 'aretoak';

    // Campos que se pueden rellenar de golpe con create() o update().
    protected $fillable = ['izena', 'exerleku_kopurua', 'lerro_kopurua'];

    //Aretoak ze eserleku dituen ezagutzeko:
    public function eserlekuak()
    {
        return $this->hasMany(Eserlekua::class, 'id_aretoa');
    }

    //Aretoak ze ekitaldi dituen ezagutzeko:
    public function ekitaldiak()
    {
        return $this->hasMany(Ekitaldia::class, 'id_aretoa');
    }

    // // Aretoak zein sarrera dituen ezagutzeko:
    // public function sarrerak()
    // {
    //     return $this->hasMany(Sarrera::class, 'id_aretoa');
    // }
}
