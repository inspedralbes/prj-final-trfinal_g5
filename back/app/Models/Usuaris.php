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

    protected $fillable = [
        'email',
        'contrasenya',
        'nom_usuari',
        'nom',
        'cognoms',
        'genere',
        'data_naixement',
        'pes',
        'altura',
        'telefon',
        'foto_perfil',
        'alergia_intolerancia',
        'lesio',
        'idRutina',
        'idDieta',
        'registre',
        'amics',
    ];


    public function dietas()
    {
        return $this->hasMany(Dieta::class,'idDieta');
    }
    public function rutinas()
    {
        return $this->hasMany(Rutina::class,'idRutina');
    }
    public $timestamps = false;

}
