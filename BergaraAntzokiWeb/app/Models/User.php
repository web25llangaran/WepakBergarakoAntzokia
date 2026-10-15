<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

//Breeze-k sortu dauena komentau eta taula egokirako modeloa sortu:
// #[Fillable(['name', 'email', 'password'])]
#[Fillable(['user_izena', 'email', 'password', 'alta_data', 'baja_data', 'izena', 'abizena', 'rola', 'nan'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            //modu honetara datubasetik irakurritako datu hauek string moduan tratatu beharrean datetime bezela tratatuko ditu:
            'alta_data' => 'datetime',
            'baja_data' => 'datetime',
        ];
    }

    //User batek kudeatu dituen sarrerak ezagutzeko:
    public function kudeatutako_sarrerak()
    {
        return $this->belongsToMany(Sarrera::class, 'kudeatu_sarrera', 'id_user', 'id_sarrera')
            ->withTimestamps();
    }

    //User batek erosi dituen sarrerak ezagutzeko: 
    public function erositako_sarrerak()
    {
        return $this->belongsToMany(Sarrera::class, 'erosi_sarrera', 'id_user', 'id_sarrera')
        ->withTimestamps();
    }

    //User batek kudeatu dituen ekitaldiak ezagutzeko:
    public function kudeatutako_ekitaldiak()
    {
        return $this->belongsToMany(Sarrera::class, 'kudeatu_ekitaldia', 'id_user', 'id_ekitaldia')
            ->withTimestamps();
    }

}
