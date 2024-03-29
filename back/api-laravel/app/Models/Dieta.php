<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'descripcio',
        'data_inici',
        'data_fi',
        'aliments_permesos',
        'aliments_restringits',
        'calories_diaries',
        'proteines',
        'carbohidrats',
        'grases',
        
    ];
    public $timestamps = false;
    public function usuario()
    {
        return $this->belongsTo(Usuaris::class, 'user_id');
    }
}

