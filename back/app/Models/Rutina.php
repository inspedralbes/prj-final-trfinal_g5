<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $table = 'rutinas';

    protected $fillable = [
        'nomExecercici',
        'dia',
        'series',
        'repeticions',
        'ejercicio_id',
    ];
    public function ejercicio()
    {
        return $this->hasMany(Ejercicio::class,'ejercicio_id');
    }
    public $timestamps = false;

    public function ejercicios()
    {
        return $this->belongsTo(Ejercicio::class , 'ejercicio_id');
    }

}
