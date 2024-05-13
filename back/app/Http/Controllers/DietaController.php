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
    public function getDietas(Request $request, $id)
    {
        $dietas = Dieta::where('id_usuari', $id)->get();
        return response()->json($dietas);
    }
    // public function getDieta(Request $request, $id)
    // {
    //     $dieta = Dieta::find($id);
    //     return response()->json($dieta);
    // }

    public function store(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $data = $request->json()->all(); // Obtener todos los datos del JSON
            $id_usuari = $data['id_usuari']; // Obtener el ID del usuario
            $apats = $data['apats']; // Obtener los apats
    
            foreach ($apats as $apat) {
                $plats = $apat['plats']; // Obtener los platos de cada apat
    
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
                        'apat' => $apat['apat'], // Agregar el campo de 'apat' del apat actual
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
            }
    
            DB::commit();
    
            return response()->json(['message' => 'Dietas guardadas correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
    
            return response()->json(['error' => 'Error al guardar las dietas: ' . $e->getMessage()], 500);
        }
    }    


    public function delete (Request $request, $id)
    {
        try {
            // Encuentra y elimina todas las dietas asociadas al ID de usuario
            Dieta::where('id_usuari', $id_usuari)->delete();
            
            return response()->json(['message' => 'Dieta eliminadas correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la dieta: ' . $e->getMessage()], 500);
        }
    }
}
