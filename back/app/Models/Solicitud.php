<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_envia_id',
        'usuario_recibe_id',
    ];

    // Relación con el usuario que envía la solicitud
    public function usuarioEnvia()
    {
        return $this->belongsTo(Usuaris::class, 'usuario_envia_id');
    }

    // Relación con el usuario que recibe la solicitud
    public function usuarioRecibe()
    {
        return $this->belongsTo(Usuaris::class, 'usuario_recibe_id');
    }
}
