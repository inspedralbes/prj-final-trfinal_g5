<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaM extends Model
{
    use HasFactory;

    protected $table = 'categoriasm';

    protected $fillable = [
        'id',
        'nomCategoria', 
        'imatgeCategoria'
    ];


    public $timestamps = false;
}
