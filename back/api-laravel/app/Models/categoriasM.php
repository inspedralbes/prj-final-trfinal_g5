<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoriasM extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCategoria',
        'nombre', 
        'imagenCategoria'
        
     
    ];
    
    
    public $timestamps = false;

}
