<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Eserlekua extends Model
{
    protected $table = 'eserlekuak';

    protected $fillable = ['id_aretoa', 'lerro_zenb', 'exerleku_zenb', 'mota'];

}
