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
    ];
    // Relación con el usuario que envía el mensaje
    protected $casts = [
        'idRutina' => 'array', // Convierte el campo 'idRutina' a un array
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
