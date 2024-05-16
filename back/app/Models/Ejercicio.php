<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;

    protected $table = 'ejercicios';

    protected $fillable = [
        'id',
        'nom', 
        'dificultat',
        'imatge',
        // 'link',
        'descripció',
        'link',
        'idCategoria',

    ];
    public function categoria()
    {
        return $this->belongsTo(CategoriaM::class, 'idCategoria');
    }
    
    public $timestamps = false;
}
