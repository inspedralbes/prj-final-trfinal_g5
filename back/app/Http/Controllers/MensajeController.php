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

        return response()->json($messages);
        
    }
}
