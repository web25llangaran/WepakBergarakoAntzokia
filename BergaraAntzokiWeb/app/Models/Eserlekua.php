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

    protected $fillable = ['id_aretoa', 'lerro_zenb', 'eserleku_zenb', 'eserleku_mota'];


    //Eserlekua ze aretotakoa den ezagutzeko:
    public function aretoa()
    {
        return $this->belongsTo(Aretoa::class, 'id_aretoa');
    }
    
    //Eserlekuak dituen sarrerak ezagutzeko:
    public function sarrerak()
    {
        return $this->hasMany(Sarrera::class, 'id_eserlekua');
    }
}
