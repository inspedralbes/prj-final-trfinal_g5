<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rutina;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RutinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $data = $request->json()->all(); // Obtener todos los datos del JSON
            $id_usuari = $data['id_usuari']; // Obtener el ID del usuario
            
            $dias = $data['dias']; // Obtener los días de entrenamiento
    
            foreach ($dias as $dia) {
                $nombre_dia = $dia['dia']; // Obtener el nombre del día
    
                $exercicis = $dia['exercicis']; // Obtener los ejercicios del día
                $data = Carbon::now();
    
                foreach ($exercicis as $exercici) {
                    // Crear una nueva rutina para cada ejercicio
                    Rutina::create([
                        'id_usuari' => $id_usuari,
                        'dia' => $nombre_dia,
                        'nom_exercici' => $exercici['nom_exercici'],
                        'series' => $exercici['series'],
                        'repeticions' => $exercici['repeticions'],
                        'data' => $data,
                        'id_exercici' => $exercici['id_exercici']
                    ]);
                }
            }
    
            DB::commit();
    
            return response()->json(['message' => 'Rutinas guardadas correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
    
            return response()->json(['error' => 'Error al guardar las rutinas: ' . $e->getMessage()], 500);
        }
    }     

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRutina($id_usuari)
    {
        $rutina = Rutina::where('id_usuari', $id_usuari)->get();

        if (!$rutina) {
            return response()->json(['error' => 'Rutina not found'], 404);
        }

        return response()->json($rutina, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTodo($id_usuari)
    {
        try {
            // Encuentra y elimina todas las rutinas asociadas al ID de usuario
            Rutina::where('id_usuari', $id_usuari)->delete();
            
            return response()->json(['message' => 'Rutinas eliminadas correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar las rutinas: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove today's routines for the specified user.
     *
     * @param  int  $id_usuari
     * @return \Illuminate\Http\Response
     */
    public function destroyToday($id_usuari)
    {
        try {
            $today = Carbon::today()->toDateString();
            Rutina::where('id_usuari', $id_usuari)
                ->whereDate('data', $today)
                ->delete();

            return response()->json(['message' => 'Rutinas de hoy eliminadas correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar las rutinas de hoy: ' . $e->getMessage()], 500);
        }
    }

    public function destroyByDate($id_usuari, $fecha)
    {
        try {
            Rutina::where('id_usuari', $id_usuari)
                  ->whereDate('data', $fecha)
                  ->delete();
    
            return response()->json(['message' => 'Rutinas eliminadas correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar las rutinas: ' . $e->getMessage()], 500);
        }
    }
    
}
