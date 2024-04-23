<?php

namespace App\Http\Controllers;

use App\Models\Usuaris;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Mail\RegistroCorreo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


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
                'alergia_intolerancia' => 'string',
                'lesio' => 'string',
                'registre' => 'string',
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

            $usuari->save();
           \Mail::to($usuari->email)->send(new RegistroCorreo($usuari));

            $idUsuario = $usuari->id;

            return response()->json([
                'status' => 1,
                'message' => 'Usuari creat correctament',
                'idUsuario' => $idUsuario,
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
                    'id' => $usuari->id,
                    'foto_perfil' => $usuari->foto_perfil,
                    'registre' => $usuari->registre,
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
    

    public function mostrarUsuario(Request $request, string $id)
    {
        $usuario = Usuaris::find($id);

        if ($usuario) {
            return response()->json([
                'status' => 1,
                'usuario' => $usuario
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'No se encontró ningún usuario'
            ]);
        }

        $id = $request->input('id');
        $nombre = $request->input('nombre');

        $usuario = Usuaris::where('id', $id)
            ->orWhere('nom', 'LIKE', '%' . $nombre . '%')
            ->first();

    if ($usuario) {
        return response()->json([
            'status' => 1,
            'usuario' => $usuario
        ]);
    } else {
        return response()->json([
            'status' => 0,
            'message' => 'No se encontró ningún usuario'
        ]);
    }
}
    public function comprovarCorreuUsuari(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $usuari = Usuaris::where('email', $request->email)->first();

        if ($usuari) {
            return response()->json([
                'status' => 1,
                'message' => 'El correu ja es troba registrar'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Correo no encontrado'
            ]);
        }
    }

    public function editarUsuari(Request $request, $id)
    {   
        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|string|max:255',
            'cognoms' => 'sometimes|string|max:255',
            'data_naixement' => 'sometimes|date',
            'genere' => 'sometimes|string',
            'pes' => 'sometimes|numeric',
            'altura' => 'sometimes|numeric',
            'telefon' => 'sometimes|integer|digits:9',
            'foto_perfil' => 'sometimes|mimetypes:image/jpeg,image/png,image/jpg',
            'alergia_intolerancia' => 'sometimes|max:255',
            'lesio' => 'sometimes|max:255',
            'registre' => 'sometimes|boolean',
        ]);
    
        // Si la validación falla, devuelve una respuesta con el error
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Error en la validación: ' . $validator->errors()->first()
            ]);
        }
    
        // Busca el usuario por su ID
        $usuari = Usuaris::find($id);
    
        // Si el usuario no existe, devuelve un error
        if (!$usuari) {
            return response()->json([
                'status' => 0,
                'message' => 'Usuario no encontrado'
            ]);
        }
    
        // Actualiza los campos del usuario con los datos recibidos en la solicitud
        $usuari->fill($request->all());
    
        // Procesa la foto de perfil si se ha proporcionado
        if ($request->hasFile('foto_perfil')) {
            $foto_perfil = $request->file('foto_perfil');
            
            // Accede al tipo de archivo dentro del objeto anidado
            $tipoArchivo = $foto_perfil->getClientMimeType();
            
            // Verifica el tipo de archivo
            if ($tipoArchivo === 'image/jpeg' || $tipoArchivo === 'image/png' || $tipoArchivo === 'image/jpg') {
                // El archivo es una imagen, puedes proceder con el almacenamiento
                $filename = $foto_perfil->getClientOriginalName(); // Obtiene el nombre original del archivo
                $path = $foto_perfil->storeAs('img', $filename, 'public'); // Almacena el archivo en la carpeta "public/storage/img"
    
                // Asigna la ruta de la imagen al atributo 'foto_perfil' del modelo
                $usuari->foto_perfil = $path;
            } else {
                // El archivo no es una imagen válida, devuelve un error
                return response()->json([
                    'status' => 0,
                    'message' => 'El archivo proporcionado no es una imagen válida. Por favor, asegúrate de que sea un archivo JPEG, PNG o JPG.'
                ]);
            }
        }
    
        // Guarda los cambios en la base de datos
        $usuari->save();
    
        // Devuelve una respuesta con el mensaje de éxito
        return response()->json([
            'status' => 1,
            'message' => 'Usuario actualizado correctamente'
        ]);
    }
}    