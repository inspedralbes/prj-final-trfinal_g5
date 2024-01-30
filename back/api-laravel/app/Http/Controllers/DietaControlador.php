<?php

namespace App\Http\Controllers;

use App\Models\Dieta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DietaControlador extends Controller
{
    public function crearDieta(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string|max:255',
            'data_inici' => 'required|date',
            'data_fi' => 'required|date',
            'aliments_permesos' => 'required|string|max:255',
            'aliments_restringits' => 'required|string|max:255',
            'calories_diaries' => 'required|numeric|max:10',
            'proteines' => 'required|numeric|max:10',
            'carbohidrats' => 'required|numeric|max:10',
            'grases' => 'required|numeric|max:10',
        ]);
        
        // Crear la dieta y asociarla al usuario actual
        $user = Auth::user();
        $dieta = Dieta::create([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'data_inici' => $request->data_inici,
            'data_fi' => $request->data_fi,
            'aliments_permesos' => $request->aliments_permesos,
            'aliments_restringits' => $request->aliments_restringits,
            'calories_diaries' => $request->calories_diaries,
            'proteines' => $request->proteines,
            'carbohidrats' => $request->carbohidrats,
            'grases' => $request->grases,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Dieta creada correctamente',
            'dieta' => $dieta,
        ]);
    }
}
