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
            $mensaje->mensaje = $request->input('mensaje');
            $mensaje->leido = 0;
            $mensaje->idRutina=$request->idRutina;
          
            
    
            // Procesar la imagen si está presente en la solicitud
            if ($request->has('imagen_base64')) {
                // Decodificar la imagen base64 y guardarla en el sistema de archivos
                $base64Image = $request->imagen_base64;
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image)); // Eliminar el encabezado 'data:image/jpeg;base64,' para obtener solo los datos de la imagen
    
                // Generar un nombre único para el archivo de imagen
                $originalFileName = 'imagen_' . uniqid() . '.jpg';
    
                // Guardar la imagen en la ruta de almacenamiento
                file_put_contents(public_path('storage/imagen/' . $originalFileName), $imageData);
    
                // Asignar el nombre del archivo de imagen al mensaje
                $mensaje->imagen = $originalFileName;
            }
    
            // Procesar el video si está presente en la solicitud
            if ($request->has('video_base64')) {
                // Decodificar el video base64 y guardarlo en el sistema de archivos
                $base64Video = $request->video_base64;
                $videoData = base64_decode(preg_replace('#^data:video/\w+;base64,#i', '', $base64Video));
    
                // Generar un nombre único para el archivo de video
                $originalFileName = 'video_' . uniqid() . '.mp4';
    
                // Guardar el video en la ruta de almacenamiento
                file_put_contents(public_path('storage/video/' . $originalFileName), $videoData);
    
                // Asignar el nombre del archivo de video al mensaje
                $mensaje->video = $originalFileName; // Guardarlo en la misma columna que la imagen
            }
    
            // Guardar el mensaje en la base de datos
            $mensaje->save();
    
            return response()->json([
                'status' => 1,
                'message' => 'Mensaje enviado',
                'mensaje' => $mensaje
            ]);
        } catch (\Exception $e) {
            // Log the detailed error message
            \Log::error('Error al enviar el mensaje: ' . $e->getMessage());
        
            // Return a response with a more informative error message
            return response()->json([
                'status' => 0,
                'message' => 'Error al enviar el mensaje: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function mostrarUltimoMensajeEntreEllos($usuari1, $usuari2)
    {
        // Obtener el último mensaje enviado y recibido entre los dos usuarios
        $message = Mensaje::where(function ($query) use ($usuari1, $usuari2) {
            $query->where('usuario_envia_mensaje', $usuari1)
                ->where('usuario_recibe_mensaje', $usuari2);
        })->orWhere(function ($query) use ($usuari1, $usuari2) {
            $query->where('usuario_envia_mensaje', $usuari2)
                ->where('usuario_recibe_mensaje', $usuari1);
        })->orderBy('created_at', 'desc')->first();
        if ($message == null) {
            return response()->json([
                'status' => 0,
                'message' => 'No hay mensajes entre los usuarios'
            ]);
        }
        else{
        return response()->json([
            'status' => 1,
            'message' => 'Mensaje encontrado',
            'message' => $message
        ]);
    }
    }
    
    
    
    
}
