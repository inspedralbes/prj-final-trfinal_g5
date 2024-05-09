<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;

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
}
