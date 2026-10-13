<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aretoa extends Model
{
    //aretoak taulakin bat datorren klasea sortu:
    // protected $table = 'aretoak';
    protected $fillable = ['izena', 'exerleku_kopurua', 'lerro_kopurua'];
}
