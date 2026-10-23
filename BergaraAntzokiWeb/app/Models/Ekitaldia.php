<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekitaldia extends Model
{
    use HasFactory;
    protected $table = 'ekitaldiak';

    protected $fillable = ['izena', 'deskripzioa', 'ekitaldi_mota', 'data', 'irudia'];
    protected $casts = ['data' => 'datetime'];

   
    // //Ekitaldia zein user-ek kudeatu duen ezagutzeko:
    // public function kudeatzaileak()
    // {
    //     return $this->belongsToMany(User::class, 'kudeatu_ekitaldia', 'id_user', 'id_ekitaldia')
    //         ->withTimestamps();
    // }

    // //Ekitaldiak zein areto dituen ezagutzeko:
    // public function aretoak()
    // {
    //     return $this->belongsToMany(Aretoa::class, 'ekitaldia_izan_aretoa', 'id_aretoa', 'id_ekitaldia')
    //         ->withTimestamps();
    // }

}
