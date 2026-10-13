<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sarrera extends Model
{
    //sarrerak taulakin bat datorren klasea sortu:
    // protected $table = 'sarrerak';
    protected $fillable = ['id_ekitaldia', 'data', 'lerro_zenb', 'exerleku_zenb', 'mota', 'prezioa'];
    protected $casts =['data'=>'datetime',
                        'prezioa'=>'decimal:2'];
}
