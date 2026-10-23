<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ErosiSarrera extends Model
{
    use HasFactory;
    protected $table = 'erosi_sarrera';

    protected $fillable = ['id_sarrera', 'id_user'];
}
