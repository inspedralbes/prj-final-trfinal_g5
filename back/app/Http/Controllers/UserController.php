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
use App\Models\Solicitud;



class UserController extends Controller

{
    public function registre(Request $request)
{
    try {
        $validator = $request->validate([
            'email' => 'required|string|email|max:255|unique:usuaris',
            'contrasenya' => 'required|string|min:6',
            // 'tipus' => 'string',
            'nom_usuari' => 'required|string|max:255|unique:usuaris',
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
        $usuari->nom_usuari = $request->nom_usuari;
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
        if ($request->filled(['email', 'contrasenya','nom', 'nom_usuari', 'cognoms', 'data_naixement', 'genere','pes','altura','telefon'])) {
            $usuari->registre = true;
        }

        $usuari->save();
        // \Mail::to($usuari->email)->send(new RegistroCorreo($usuari));

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
            'registre' => $usuari->registre
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
                    'nom_usuari' => $usuari->nom_usuari,
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
    public function comprovarNomUsuari(Request $request)
    {
        $request->validate([
            'nom_usuari' => 'required|string|max:255',
        ]);
        

        $usuari = Usuaris::where('nom_usuari', $request->nom_usuari)->first();

        if ($usuari) {
            return response()->json([
                'status' => 1,
                'message' => 'El nom d\'usuari ja es troba registrar'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Nom d\'usuari no trobat'
            ]);
        }
    }
    public function editarUsuari(Request $request, $id)
    {   
        // Validación de los datos recibidos en la solicitud
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|string|max:255',
            'cognoms' => 'sometimes|string|max:255',
            'nom_usuari' => 'sometimes|string|max:255',
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
                        !empty($usuari->nom_usuari) &&
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
    
    public function mostrarUsuariosExceptoYo(Request $request, $idUsuario)
    {
      // Busca el usuario por el ID proporcionado desde el frontend
      $usuario = Usuaris::find($idUsuario);

      if (!$usuario) {
        return response()->json([
            'status' => 0,
            'message' => 'Usuario no encontrado'
        ]);
      }

      // Obtenemos la lista de IDs de amigos del usuario
      $amigosIds = $usuario->amics ? json_decode($usuario->amics, true) : [];

      // Obtenemos la lista de IDs de usuarios a los que se les ha enviado una solicitud de amistad
      $solicitudesEnviadasIds = Solicitud::where('usuario_envia_id', $idUsuario)
                                        ->pluck('usuario_recibe_id')
                                        ->toArray();

      // Unimos las listas de amigos y usuarios a los que se les ha enviado solicitud
      $usuariosExcluidosIds = array_merge($amigosIds, $solicitudesEnviadasIds);

      // Buscamos todos los usuarios excepto el usuario actual y los usuarios excluidos
      $usuarios = Usuaris::select('nom', 'nom_usuari', 'cognoms','foto_perfil','id')
                        ->where('id', '!=', $idUsuario)
                        ->whereNotIn('id', $usuariosExcluidosIds)
                        ->get();

      if ($usuarios->isEmpty()) {
          return response()->json([
              'status' => 0,
              'message' => 'No se encontraron otros usuarios.'
          ]);
      }

      // Retorna la lista de usuarios excepto el usuario proporcionado, tus amigos y usuarios a los que se les ha enviado solicitud
      return response()->json([
          'status' => 1,
          'message' => 'Usuarios excluyendo el usuario proporcionado, tus amigos y usuarios a los que se les ha enviado solicitud.',
          'usuarios' => $usuarios
      ]);
  }



     public function getUsers(Request $request) {
          $users = Usuaris::all();
          return response()->json($users);
     }

     public function getAmics(Request $request, string $id)
    {
      // Busca al usuario por su ID
      $usuario = Usuaris::find($id);

      if (!$usuario) {
          return response()->json([
              'status' => 0,
              'message' => 'Usuario no encontrado'
          ]);
      }

      // Verifica si el usuario tiene amigos
      if (!$usuario->amics) {
          return response()->json([
              'status' => 1,
              'message' => 'El usuario no tiene amigos',
              'amigos' => []
          ]);
      }

      // Decodifica el campo "amics" que está en formato JSON
      $amigos = json_decode($usuario->amics, true);

      // Verifica si la decodificación fue exitosa y $amigos es un array
      if (!is_array($amigos)) {
          return response()->json([
              'status' => 0,
              'message' => 'Error al decodificar la lista de amigos'
          ]);
      }

      // Verifica si $amigos no está vacío
      if (empty($amigos)) {
          return response()->json([
              'status' => 1,
              'message' => 'El usuario no tiene amigos',
              'amigos' => []
          ]);
      }

      // Encuentra los usuarios que son amigos del usuario actual
      $amigosUsuarios = Usuaris::whereIn('id', $amigos)->get();

      // Devuelve la lista de amigos del usuario
      return response()->json([
          'status' => 1,
          'message' => 'Amigos del usuario',
          'amigos' => $amigosUsuarios
      ]);
  }

}    