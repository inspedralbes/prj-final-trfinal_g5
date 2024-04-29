<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Ejercicio;


class EjercicioController extends Controller
{
   public function getEjercicios(Request $request)
   {
       $ejercicios = Ejercicio::all();
       return response()->json($ejercicios);
   }
}
