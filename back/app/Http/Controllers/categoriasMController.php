<?php

namespace App\Http\Controllers;
use App\Models\categoriasM;

use Illuminate\Http\Request;

class categoriasMController extends Controller
{
    //
    public function processJson(Request $request){
        $contingutJSON=file_get_contents(storage_path('categories.json'));



        $datos = json_decode($contingutJSON, true);

        foreach ($datos as $key => $value) {
            categoriasM::create([
            'idCategoria' => $value['idCategoria'],
            'nombreCategoria' => $value['nombreCategoria'],
            'imagenCategoria' => $value['imagenCategoria']
            
           
        ]);
            
        }
    }
}