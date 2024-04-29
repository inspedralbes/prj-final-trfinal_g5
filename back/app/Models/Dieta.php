<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    use HasFactory;
    
    protected $table = 'dietas';

    protected $fillable = [
        'nom_plat',
        'data_inici',
        'data_fi',
        'calories',
        'proteines',
        'carbohidrats',
        'grases',
        
    ];
    public $timestamps = false;

    public function aliments()
    {
        return $this->belongsTo(Aliments::class , 'nom_plat');
    }
}

