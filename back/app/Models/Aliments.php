<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aliments extends Model
{
    use HasFactory;

    protected $table = 'aliments';

    protected $fillable = [
        'nom_plat',
        'apat',
        'ingredients',
        // 'nom_ingredient',
        // 'quantitat',
        // 'unitat',
        'calories',
        'proteines',
        'hidrats',
        'greixos',
    ];
}
