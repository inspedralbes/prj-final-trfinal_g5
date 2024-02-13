<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DietaControlador;


Route::get('/usuari', [UserController::class, 'usuari']);
Route::get('/usuari/{nom}', [UserController::class, 'usuariId']);
Route::post('/crear-dieta', [DietaControlador::class, 'crearDieta']);
Route::post('/registre', [UserController::class, 'registre']);
Route::post('/loguejat', [UserController::class, 'loguejat']);
Route::post('/deslojegat', [UserController::class, 'deslojegat']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
