<?php

namespace App\Http\Controllers;

use App\Models\Dieta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DietaController extends Controller
{

    public function getDietas(Request $request)
    {
        $dietas = Dieta::all();
        return response()->json($dietas);
    }
}
