<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EkitaldiaIzanAretoa extends Model
{
    use HasFactory;
    protected $table = 'ekitaldia_izan_aretoa';

    protected $fillable = ['id_ekitaldia', 'id_aretoa'];
}
