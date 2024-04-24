<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rutina;

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
        try {
            $rutinas = $request->json()->all(); // Obtener todas las rutinas del JSON

            foreach ($rutinas as $rutina) {
                $dia = $rutina['dia'];

                foreach ($rutina['exercicis'] as $exercici) {
                    // Crear una nueva rutina para cada ejercicio
                    Rutina::create([
                        'dia' => $dia,
                        'nom_exercici' => $exercici['nom_exercici'],
                        'series' => $exercici['series'],
                        'repeticions' => $exercici['repeticions'],
                        'id_exercici' => $exercici['id_exercici']
                    ]);
                }
            }

            return response()->json(['message' => 'Rutinas guardadas correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar las rutinas: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
