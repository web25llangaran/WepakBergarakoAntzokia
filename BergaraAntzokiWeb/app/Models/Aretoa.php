<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aretoa extends Model
{
    protected $table = 'aretoak';

    protected $fillable = ['izena', 'exerleku_kopurua', 'lerro_kopurua'];

    // //Aretoak zein ekitaldi dituen ezagutzeko:
    // public function ekitaldiak()
    // {
    //     return $this->belongsToMany(Ekitaldia::class, 'ekitaldia_izan_aretoa', 'id_aretoa', 'id_ekitaldia')
    //         ->withTimestamps();
    // }

    // //Aretoak ze eserleku dituen ezagutzeko:
    // public function eserlekuak()
    // {
    //     return $this->hasMany(Eserlekua::class, 'id_aretoa');
    // }
    
}
