<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eserlekuak extends Model
{
    //eserlekuak taulakin bat datorren klasea sortu:
    // protected $table = 'eserlekuak';
    protected $fillable = ['id_aretoa', 'lerro_zenb', 'exerleku_zenb', 'mota'];
}
