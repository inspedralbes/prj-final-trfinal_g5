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
        $request->validate([
            'dia' => 'required|string',
            'exercicis' => 'required|array', // Verifica si la estructura de los ejercicios es correcta
        ]);
        
        // Recupera los datos de la solicitud
        $datosRutina = $request->input('exercicis');

        // Itera sobre los datos y guárdalos en la base de datos
        foreach ($datosRutina as $rutina) {
            $dia = $rutina['dia'];
            $exercicis = $rutina['exercicis'];

            foreach ($exercicis as $exercicio) {
                $nom_exercici = $exercicio['nom_exercici'];
                $series = $exercicio['series'];
                $repeticions = $exercicio['repeticions'];
                $id_exercici = $exercicio['id_exercici'];

                // Crea una nueva instancia del modelo Rutina y guárdala en la base de datos
                $nuevaRutina = new Rutina();
                $nuevaRutina->dia = $dia;
                $nuevaRutina->nom_exercici = $nom_exercici;
                $nuevaRutina->series = $series;
                $nuevaRutina->repeticions = $repeticions;
                $nuevaRutina->id_exercici = $id_exercici;
                $nuevaRutina->save();
            }
        }

        // Respuesta de éxito
        return response()->json(['message' => 'Rutina guardada correctamente'], 200);
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
