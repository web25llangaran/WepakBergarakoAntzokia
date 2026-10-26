<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sarrera extends Model
{
    use HasFactory;
    protected $table = 'sarrerak';

    protected $fillable = ['id_ekitaldia', 'id_aretoa', 'id_eserlekua', 'id_user', 'data', 'prezioa'];
    protected $casts = ['prezioa' => 'decimal:2', 'data' => 'datetime',];


    //Sarrera zein erabiltzailek erosi duen ezagutzeko.
    public function eroslea()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    //Sarrera zein ekitalditarako den ezagutzeko.
    public function ekitaldia()
    {
        return $this->belongsTo(Ekitaldia::class, 'id_ekitaldia');
    }

    //Sarrera zein eserlekutarako den ezagutzeko.
    public function eserlekua()
    {
        return $this->belongsTo(Eserlekua::class, 'id_eserlekua');
    }

    //Sarrera zein aretotarako den ezagutzeko
    public function aretoa()
    {
        return $this->belongsTo(Aretoa::class, 'id_aretoa');
    }
}
