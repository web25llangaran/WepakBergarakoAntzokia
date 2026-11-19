<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Modelo de la tabla "ekitaldiak" (eventos). Representa un evento y sus relaciones.
class Ekitaldia extends Model
{
    use HasFactory;
    protected $table = 'ekitaldiak';

    // Campos que se pueden rellenar con create()/update(). El cast convierte "data" en un objeto fecha para poder formatearla.
    protected $fillable = ['id_aretoa', 'izena', 'deskripzioa', 'ekitaldi_mota', 'data', 'irudia'];
    protected $casts = ['data' => 'datetime'];


    //Ekitaldiak zein areto duen ezagutzeko:
    public function aretoa()
    {
        return $this->belongsTo(Aretoa::class, 'id_aretoa');
    }

    //Ekitaldiak zenbat sarrera dituen ezagutzeko:
    public function sarrerak()
    {
        return $this->hasMany(Sarrera::class, 'id_ekitaldia');
    }

}
