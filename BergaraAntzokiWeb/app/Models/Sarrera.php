<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sarrera extends Model
{
    protected $table = 'sarrerak';

    protected $fillable = ['id_ekitaldia', 'id_aretoa', 'id_eserlekua', 'data', 'prezioa'];
    protected $casts = ['prezioa' => 'decimal:2'];

    // Sarrera bat zein erabiltzailek kudeatu duten ezagutzeko:
    public function kudeatzaileak()
    {
        return $this->belongsToMany(User::class, 'kudeatu_sarrera', 'id_sarrera', 'id_user')
            ->withTimestamps();
    }

    //Sarrera zein erabiltzailek erosi duen ezagutzeko.
    public function eroslea(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'erosi_sarrera', 'id_sarrera', 'id_user')
            ->withTimestamps();
    }
}
