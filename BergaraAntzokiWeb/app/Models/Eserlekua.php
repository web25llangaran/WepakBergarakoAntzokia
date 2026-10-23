<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eserlekua extends Model
{
    use HasFactory;
    protected $table = 'eserlekuak';

    protected $fillable = ['id_aretoa', 'lerro_zenb', 'exerleku_zenb', 'eserleku_mota'];

}
