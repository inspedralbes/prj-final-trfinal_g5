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
    public function MostrarUsuarioSolicitudesEnviades($id){
        $enviar = Solicitud::where('usuario_envia_id', $id)->get();
        
        if ($enviar->isEmpty()) {
            return response()->json([
                'status' => 0,
                'message' => 'No tienes solicitudes enviadas',
            ]);
        }
    
        return response()->json([
            'status' => 1,
            'message' => 'Solicitudes enviadas',
            'enviadas' => $enviar
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

   
    public function AceptarAmigo(Request $request, $id)
{
    try {
        // Busca la solicitud por su ID
        $solicitud = Solicitud::find($id);

        // Verifica si la solicitud existe
        if (!$solicitud) {
            return response()->json([
                'status' => 0,
                'message' => 'Solicitud no encontrada'
            ]);
        }

        // Encuentra los usuarios involucrados en la solicitud
        $usuarioEnvia = Usuaris::find($solicitud->usuario_envia_id);
        $usuarioRecibe = Usuaris::find($solicitud->usuario_recibe_id);

        // Verifica si ambos usuarios existen
        if (!$usuarioEnvia || !$usuarioRecibe) {
            return response()->json([
                'status' => 0,
                'message' => 'Uno o ambos usuarios no encontrados'
            ]);
        }

        // Agrega a usuarioEnvia a la lista de amigos de usuarioRecibe
        $amicsRecibe = json_decode($usuarioRecibe->amics, true);
        $amicsRecibe[] = $usuarioEnvia->id;
        $usuarioRecibe->amics = json_encode($amicsRecibe);
        $usuarioRecibe->save();

        // Agrega a usuarioRecibe a la lista de amigos de usuarioEnvia
        $amicsEnvia = json_decode($usuarioEnvia->amics, true);
        $amicsEnvia[] = $usuarioRecibe->id;
        $usuarioEnvia->amics = json_encode($amicsEnvia);
        $usuarioEnvia->save();

        // Elimina la solicitud de la base de datos
        $solicitud->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Solicitud aceptada correctamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 0,
            'message' => 'Error al aceptar la solicitud: ' . $e->getMessage()
        ]);
    }
}

    
    


    public function RechazarAmigo(Request $request , $id)
    {
        $solicitud = Solicitud::find($id);
        $solicitud->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Solicitud rechazada correctamente'
        ]);
    }
    
    
}
