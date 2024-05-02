<?php

namespace App\Http\Controllers;

use App\Models\Dieta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DietaController extends Controller
{

    public function getDietas(Request $request)
    {
        $dietas = Dieta::all();
        return response()->json($dietas);
    }

    public function getDieta(Request $request, $id)
    {
        $dieta = Dieta::find($id);
        return response()->json($dieta);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $data = $request->json()->all(); // Obtener todos los datos del JSON
            $id_usuari = $data['id_usuari']; // Obtener el ID del usuario
            $plats = $data['plats']; // Obtener los platos
    
            foreach ($plats as $plat) {
                // Calcular la fecha de inicio como la fecha actual
                $data_inici = Carbon::now();
                
                // Calcular la fecha de finalización como un mes después de la fecha de inicio
                $data_fi = Carbon::now()->addMonth();

                $ingredientsJson = json_encode($plat['ingredients']);
                
                // Crear una nueva dieta para cada platillo
                Dieta::create([
                    'id_usuari' => $id_usuari,
                    'nom_plat' => $plat['nom_plat'],
                    'apat' => $plat['apat'],
                    'ingredients' => $ingredientsJson,
                    'data_inici' => $data_inici,
                    'data_fi' => $data_fi,
                    'calories' => $plat['calories'],
                    'proteines' => $plat['proteines'],
                    'carbohidrats' => $plat['carbohidrats'],
                    'grases' => $plat['greixos'],
                    // Ajusta aquí según la estructura real de tu base de datos
                ]);
            }
    
            DB::commit();
    
            return response()->json(['message' => 'Dietas guardadas correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
    
            return response()->json(['error' => 'Error al guardar las dietas: ' . $e->getMessage()], 500);
        }
    } 
}
