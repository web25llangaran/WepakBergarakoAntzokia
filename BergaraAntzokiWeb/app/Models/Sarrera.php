<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Modelo de la tabla "sarrerak" (entradas). Une un usuario, un evento y una butaca, con su precio.
class Sarrera extends Model
{
    use HasFactory;

    protected $table = 'sarrerak';

    // Campos rellenables y cast del precio a decimal con 2 decimales.
    protected $fillable = ['id_ekitaldia', 'id_eserlekua', 'id_user', 'prezioa'];

    protected $casts = ['prezioa' => 'decimal:2'];

    // Sarrera zein erabiltzailek erosi duen ezagutzeko.
    public function eroslea(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Sarrera zein ekitalditarako den ezagutzeko.
    public function ekitaldia(): BelongsTo
    {
        return $this->belongsTo(Ekitaldia::class, 'id_ekitaldia');
    }

    // Sarrera zein eserlekutarako den ezagutzeko.
    public function eserlekua(): BelongsTo
    {
        return $this->belongsTo(Eserlekua::class, 'id_eserlekua');
    }

    // //Sarrera zein aretotarako den ezagutzeko
    // public function aretoa()
    // {
    //     return $this->belongsTo(Aretoa::class, 'id_aretoa');
    // }
}
