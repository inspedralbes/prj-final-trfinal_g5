<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
    protected $table = 'messages';

     protected $fillable = [
        'usuario_envia_mensaje',
        'usuario_recibe_mensaje',
        'mensaje',
        'imagen',
        'video',
        'leido',
        'idRutina',
        'idDieta',
    ];
    
    public function usuarioEnvia()
    {
        return $this->belongsTo(Usuaris::class, 'usuario_envia_mensaje');
    }
    public function usuarioRecibe()
    {
        return $this->belongsTo(Usuaris::class, 'usuario_recibe_mensaje');
    }
}
