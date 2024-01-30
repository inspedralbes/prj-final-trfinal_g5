<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Usuaris extends Model implements Authenticatable
{
    use HasFactory, Notifiable, AuthenticableTrait;

    protected $table = 'usuaris';
    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'contrasenya',
        'nom',
        'cognoms',
        'genere',
        'data_naixement',
        'pes',
        'altura',
        'telefon',
        'foto_perfil',
    ];

    public $timestamps = false;

    public function dietas()
    {
        return $this->hasMany(Dieta::class);
    }
}
