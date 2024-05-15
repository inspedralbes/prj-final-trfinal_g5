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
use Illuminate\Support\Facades\Storage;



class UserController extends Controller

{
    public function registre(Request $request)
{
    try {
        $validator = $request->validate([
            'email' => 'required|string|email|max:255|unique:usuaris',
            'contrasenya' => 'required|string|min:6',
            // 'tipus' => 'string',
            'nom' => 'required|string|max:255',
            'cognoms' => 'required|string|max:255',
            'data_naixement' => 'date',
            'genere' => 'string',
            'pes' => 'numeric',
            'altura' => 'numeric',
            'telefon' => 'integer|digits:9',
        ]);

        $usuari = new Usuaris();
        $usuari->email = $request->email;
        $usuari->contrasenya = Hash::make($request->contrasenya);
        $usuari->nom = $request->nom;
        $usuari->cognoms = $request->cognoms;

        if ($request->has('data_naixement')) {
            $usuari->data_naixement = $request->data_naixement;
        }
        if ($request->has('genere')) {
            $usuari->genere = $request->genere;
        }

        if ($request->has('tipus')) {
            $usuari->tipus = $request->tipus;
        }

        if ($request->has('pes')) {
            $usuari->pes = $request->pes;
        }

        if ($request->has('altura')) {
            $usuari->altura = $request->altura;
        }

        if ($request->has('telefon')) {
            $usuari->telefon = $request->telefon;
        }
        
        // Verificar si todos los campos necesarios están presentes y no están vacíos
        if ($request->filled(['email', 'contrasenya', 'nom', 'cognoms', 'data_naixement', 'genere','pes','altura','telefon'])) {
            $usuari->registre = true;
        }

        $usuari->save();
        \Mail::to($usuari->email)->send(new RegistroCorreo($usuari));

        $idUsuario = $usuari->id;

        return response()->json([
            'status' => 1,
            'message' => 'Usuari creat correctament',
            'idUsuario' => $idUsuario,
            'telefon' => $usuari->telefon,
            'tipus' => $usuari->tipus,
            'data_naixement' => $usuari->data_naixement,
            'genere' => $usuari->genere,
            'pes' => $usuari->pes,
            'altura' => $usuari->altura,
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
                    'tipus' => $usuari->tipus,  
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
            'data_naixement' => 'sometimes',
            'genere' => 'sometimes',
            'pes' => 'sometimes',
            'altura' => 'sometimes',
            'telefon' => 'sometimes|max:9|min:0',
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
        $usuari->fill($request->except('foto_perfil'));
    
        // Verificar si todos los campos están llenos
        $camposLlenos = !empty($usuari->nom) &&
                       !empty($usuari->cognoms) &&
                       !empty($usuari->data_naixement) &&
                       !empty($usuari->genere) &&
                       !empty($usuari->pes) &&
                       !empty($usuari->altura) &&
                       !empty($usuari->telefon);
    
        // Establecer el campo 'registre' en true o false según si todos los campos están llenos
        $usuari->registre = $camposLlenos;
    
        // Manejar la imagen de perfil
        if ($request->has('foto_perfil_base64')) {
            // Obtener el archivo base64 de la solicitud
            $base64Image = $request->foto_perfil_base64;
    
            // Decodificar la cadena base64 en una imagen
            $imageData = base64_decode($base64Image);
    
            // Usar el nombre original del archivo
            $originalFileName = 'perfil_' . uniqid() . '.jpg'; // Generar un nombre único para el archivo
            
            // Mover la imagen a la ubicación deseada con el nombre original
            file_put_contents(public_path('storage/imagenes_perfil/' . $originalFileName), $imageData);
    
            // Actualizar el campo de la imagen de perfil en la base de datos
            $usuari->foto_perfil = $originalFileName;
        }    
    
        // Guarda los cambios en la base de datos
        $usuari->save();
    
        // Devuelve una respuesta con el mensaje de éxito
        return response()->json([
            'status' => 1,
            'message' => 'Usuario actualizado correctamente',
            'foto_perfil' => $usuari->foto_perfil,
            'registre' => $usuari->registre
        ]);
    }
    
    public function listarUsuaris()
    {
        try {
            $usuaris = Usuaris::all();
            return response()->json([
                'status' => 1,
                'usuaris' => $usuaris
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Error al obtener los usuarios: ' . $e->getMessage()
            ]);
        }
    }

    public function eliminarUsuari($id) {
        try {
            $usuari = Usuaris::find($id);
            if (!$usuari) {
                return response()->json(['status' => 0, 'message' => 'Usuario no encontrado']);
            }
            $usuari->delete();
            return response()->json(['status' => 1, 'message' => 'Usuario eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => 'Error al eliminar el usuario: ' . $e->getMessage()]);
        }
    }
    

}    