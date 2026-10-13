<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekitaldia extends Model
{
    //ekitaldiak taulakin bat datorren klasea sortu:
    // protected $table = 'ekitaldiak';
    protected $fillable = ['izena', 'deskripzioa', 'mota', 'data'];
    protected $casts =['data'=>'datetime'];
}

