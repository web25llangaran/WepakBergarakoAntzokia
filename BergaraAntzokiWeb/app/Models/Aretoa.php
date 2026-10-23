<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aretoa extends Model
{
    use HasFactory;
    protected $table = 'aretoak';

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
    
}
