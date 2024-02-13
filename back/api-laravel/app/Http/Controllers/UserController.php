<?php

namespace App\Http\Controllers;

use App\Models\Usuaris;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function registre(Request $request)
    {
        \Log::info($request->all());
        try {
            $validator = $request->validate([
                'email' => 'required|string|email|max:255|unique:usuaris',
                'contrasenya' => 'required|string|min:6',
                'nom' => 'required|string|max:255',
                'cognoms' => 'required|string|max:255',
                'data_naixement' => 'date',
                'genere' => 'string',
                'pes' => 'numeric',
                'altura' => 'numeric',
                'telefon' => 'integer|digits:9',
                'foto_perfil' => 'image|mimes:jpeg,png,jpg',
            ]);


            $usuari = new Usuaris();
            $usuari->email = $request->email;
            $usuari->contrasenya = Hash::make($request->contrasenya);
            $usuari->nom = $request->nom;
            $usuari->cognoms = $request->cognoms;
            $usuari->data_naixement = $request->data_naixement;
            $usuari->genere = $request->genere;

            if ($request->has('pes')) {
                $usuari->pes = $request->pes;
            }

            if ($request->has('altura')) {
                $usuari->altura = $request->altura;
            }

            if ($request->has('telefon')) {
                $usuari->telefon = $request->telefon;
            }

            $usuari->foto_perfil = $request->foto_perfil;
            $usuari->save();

            return response()->json([
                'status' => 1,
                'message' => 'Usuari creat correctament'
            ]);
        } catch (ValidationException $e) {
            // Captura las excepciones de validación y obtén los mensajes de error
            $errors = $e->errors();

            return response()->json([
                'status' => 0,
                'message' => 'Error en el registro: ' . implode(', ', Arr::flatten($errors))
            ]);
        } catch (\Exception $e) {
            // Captura otras excepciones y proporciona un mensaje de error general
            return response()->json([
                'status' => 0,
                'message' => 'Error en el registro: ' . $e->getMessage()
            ]);
        }
    }
    
    public function loguejat(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255',
            'contrasenya' => 'required|string|min:6',
        ]);
    
        // Cambia la línea siguiente para asignar el resultado de la consulta a $usuario
        $usuari = Usuaris::where("email", "=", $request->email)->first();
    
        if ($usuari) {
            if (Hash::check($request->contrasenya, $usuari->contrasenya)) {
                return response()->json([
                    'status' => 1,
                    'nom' => $usuari->nom,
                    'email' => $usuari->email,
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Contrasenya incorrecta'
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'usuario no registrat'
            ]);
        }
    }
    
    public function deslojegat(Request $request){
        try {
            $request->user()->tokens()->delete();
    
            return response()->json([
                'status' => 1,
                'message' => 'Usuari desloguejat correctament'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Error al desloguejar usuari'
            ]);
        }
    }

}
