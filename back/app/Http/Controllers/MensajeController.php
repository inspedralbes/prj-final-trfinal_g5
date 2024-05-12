<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;

class MensajeController extends Controller
{
    public function mostrarMensajeEntreEllos($usuari1, $usuari2)
    {
        // Obtener mensajes enviados y recibidos entre los dos usuarios
        $messages = Mensaje::where(function ($query) use ($usuari1, $usuari2) {
            $query->where('usuario_envia_mensaje', $usuari1)
                ->where('usuario_recibe_mensaje', $usuari2);
        })->orWhere(function ($query) use ($usuari1, $usuari2) {
            $query->where('usuario_envia_mensaje', $usuari2)
                ->where('usuario_recibe_mensaje', $usuari1);
        })->orderBy('created_at', 'asc')->get();
        if ($messages->count() == 0) {
            return response()->json([
                'status' => 0,
                'message' => 'No hay mensajes entre los usuarios'
            ]);
        }
        else{
        return response()->json([
            'status' => 1,
            'message' => 'Mensajes encontrados',
            'messages' => $messages
        ]);
    }
        
        
        
    }
    public function enviarMensaje(Request $request, $usuari1, $usuari2) {
        try {
            $mensaje = new Mensaje();
            $mensaje->usuario_envia_mensaje = $usuari1;
            $mensaje->usuario_recibe_mensaje = $usuari2;
            $mensaje->mensaje = $request->input('mensaje'); // Obtener el mensaje del cuerpo de la solicitud
            $mensaje->leido = 0;
            $mensaje->save();
            
            return response()->json([
                'status' => 1,
                'message' => 'Mensaje enviado',
                'mensaje' => $mensaje
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Error al enviar el mensaje',
                'error' => $e->getMessage()
            ]);
        }
    }
    
}
