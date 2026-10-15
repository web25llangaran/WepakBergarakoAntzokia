<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sarrera extends Model
{
    //sarrerak taulakin bat datorren klasea sortu:
    // protected $table = 'sarrerak';
    protected $fillable = ['id_ekitaldia', 'id_aretoa', 'id_eserlekua', 'data','prezioa'];
    protected $casts =['prezioa'=>'decimal:2'];
}
