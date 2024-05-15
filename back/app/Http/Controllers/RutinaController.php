<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rutina;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RutinaController extends Controller
{
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
    public function getRutina($id_usuari)
    {
        $rutina = Rutina::where('id_usuari', $id_usuari)->get();

        if (!$rutina) {
            return response()->json(['error' => 'Rutina not found'], 404);
        }

        return response()->json($rutina, 200);
    }
    public function getRutinaId($id){
        $rutina = Rutina::find($id);
        if (!$rutina) {
            return response()->json(['error' => 'Rutina not found'], 404);
        }
    
        // Ocultar los campos id_usuario y id_rutina antes de enviar la respuesta JSON
        $rutina->makeHidden(['id_usuari', 'id']);
    
        return response()->json($rutina, 200);
    }public function saveRoutines(Request $request)
    {
        try {
            $data = $request->json()->all(); // Obtener todos los datos del JSON
            
            // Registro de los datos recibidos
            \Log::info('Datos recibidos:', $data);
            
            $routines = $data; // Obtener las rutinas del JSON
            $datas = Carbon::now();
    
            foreach ($routines as $routine) {
                // Verificar que todos los campos necesarios estén presentes en cada rutina
                $required_fields = ['id_usuari', 'dia', 'nom_exercici', 'series', 'repeticions', 'id_exercici','data'];
                foreach ($required_fields as $field) {
                    if (!isset($routine[$field])) {
                        throw new \Exception("El campo '{$field}' no está presente en una o más rutinas.");
                    }
                }
    
                // Crear una nueva rutina con los datos proporcionados
                Rutina::create([
                    'id_usuari' => $routine['id_usuari'],
                    'dia' => $routine['dia'],
                    'nom_exercici' => $routine['nom_exercici'],
                    'series' => $routine['series'],
                    'repeticions' => $routine['repeticions'],
                    'id_exercici' => $routine['id_exercici'],
                    'data'=>$datas,
                ]);
            }
    
            return response()->json(['message' => 'Rutinas guardadas correctamente'], 200);
        } catch (\Exception $e) {
            // Registro del error
            \Log::error('Error al guardar las rutinas: ' . $e->getMessage());
    
            return response()->json(['error' => 'Error al guardar las rutinas: ' . $e->getMessage()], 500);
        }
    }
}
