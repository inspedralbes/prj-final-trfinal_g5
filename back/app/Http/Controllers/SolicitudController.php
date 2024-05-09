<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    //
    public function getSolicitudes($id){
        $solicitudes = \App\Models\Solicitud::where('usuario_recibe_id', $id)->get();
        return response()->json($solicitudes);
    }

    public function store(Request $request){
        $solicitud = new \App\Models\Solicitud();
        $solicitud->usuario_envia_id = $request->usuario_envia_id;
        $solicitud->usuario_recibe_id = $request->usuario_recibe_id;
        $solicitud->save();
        return response()->json($solicitud);
    }

    public function delete($id){
        $solicitud = \App\Models\Solicitud::find($id);
        $solicitud->delete();
        return response()->json($solicitud);
    }
}
