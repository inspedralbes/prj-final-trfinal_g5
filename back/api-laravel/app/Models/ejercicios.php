<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ejercicios extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'id', // Agrega 'id' aquí para permitir la asignación masiva
        // Agrega otros atributos asignables aquí si los hay
    ];
}
