<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Usuaris;


class SolicitudController extends Controller
{
    //
    public function MostrarUsuarioSolicitudes($id){
        $solicitudes = Solicitud::where('usuario_recibe_id', $id)->get();
        
        if ($solicitudes->isEmpty()) {
            return response()->json([
                'status' => 0,
                'message' => 'No tienes solicitudes pendientes',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'message' => 'Solicitudes encontradas',
            'solicitudes' => $solicitudes
        ]);
    }
    

    public function enviarSolicitud(Request $request){
        $solicitud = new Solicitud();
        $solicitud->usuario_envia_id = $request->usuario_envia_id;
        $solicitud->usuario_recibe_id = $request->usuario_recibe_id;
        $solicitud->save();
        return response()->json([
            'status' => 1,
            'message' => 'Se ha enviado la solicitud correctamente',
        ]);
    }

    public function delete($id){
        $solicitud = \App\Models\Solicitud::find($id);
        $solicitud->delete();
        return response()->json($solicitud);
    }
    public function aceptarSolicitud(Request $request)
    {
        try {
            $solicitudId = $request->input('id');

            // Encontrar la solicitud por su ID
            $solicitud = Solicitud::find($solicitudId);

            if (!$solicitud) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Solicitud no encontrada'
                ]);
            }

            // Obtener los IDs de usuario de la solicitud
            $usuarioEnviaId = $solicitud->usuario_envia_id;
            $usuarioRecibeId = $solicitud->usuario_recibe_id;

            // Encontrar al usuario que recibe la solicitud y actualizar su lista de amigos
            $usuarioRecibe = Usuaris::find($id);
            $usuarioRecibe->amics()->attach($usuarioEnviaId);

            // Eliminar la solicitud de amistad correspondiente
            $solicitud->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Amigo añadido correctamente y solicitud eliminada'
            ]);
        } catch (\Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir
            return response()->json([
                'status' => 0,
                'message' => 'Error al agregar amigo: ' . $e->getMessage()
            ]);
        }
    }
}
