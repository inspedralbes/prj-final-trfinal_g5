<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ejercicios;
use App\Models\categoriasM;


class ejerciciosController extends Controller
{
    public function processJson(Request $request){
        $contingutJSON=file_get_contents(storage_path('ejercicios.json'));



        $datos = json_decode($contingutJSON, true);

        foreach ($datos as $key => $value) {
            ejercicios::create([
            'id' => $value['id'],
            'nombre' => $value['nombre'],
            'dificultad' => $value['dificultad'],
            'idCategoria' => $value['idCategoria'],
            'imagen' => $value['imagen'],
            'descripcion' => $value['descripcion']
        ]);
            
        }
    }
}
