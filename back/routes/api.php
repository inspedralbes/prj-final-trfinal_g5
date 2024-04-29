<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\AlimentsController;


Route::get('/usuari/{id}', [UserController::class, 'mostrarUsuario']);
Route::put('/editar-usuari/{id}', [UserController::class, 'editarUsuari']);

Route::get('/exercicis', [EjercicioController::class, 'getEjercicios']);

Route::post('/guardar-rutina', [RutinaController::class, 'store']);

Route::get('/aliments', [AlimentsController::class, 'index']);

Route::post('/registre', [UserController::class, 'registre']);
Route::post('/loguejat', [UserController::class, 'loguejat']);
Route::post('/deslojegat', [UserController::class, 'deslojegat']);

Route::post('/comprovaremail', [UserController::class, 'comprovarCorreuUsuari']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
