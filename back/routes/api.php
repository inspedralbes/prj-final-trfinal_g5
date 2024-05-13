<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\AlimentsController;
use App\Http\Controllers\DietaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\MensajeController;

Route::get('/usuaris', [UserController::class, 'getUsers']);
Route::get('/usuari/{id}', [UserController::class, 'mostrarUsuario']);
Route::put('/editar-usuari/{id}', [UserController::class, 'editarUsuari']);
Route::get('/chatUsuaris/{id}', [UserController::class, 'getAmics']);

Route::get('/usuarios-excepto/{idUsuario}', [UserController::class, 'mostrarUsuariosExceptoYo']);
Route::post('/enviar-solicitud', [SolicitudController::class, 'enviarSolicitud']);
Route::get('/mostrar-solicitudes/{id}', [SolicitudController::class, 'MostrarUsuarioSolicitudes']);
Route::get('/mostrar-solicitudes-enviades/{id}', [SolicitudController::class, 'MostrarUsuarioSolicitudesEnviades']);
Route::post('/aceptar-solicitud/{id}', [SolicitudController::class, 'AceptarAmigo']);
Route::delete('/eliminar-solicitud/{id}', [SolicitudController::class, 'RechazarAmigo']);

Route::post('/enviar-mensaje/{usuari1}/{usuari2}', [MensajeController::class, 'enviarMensaje']);
Route::get('missatges/{userId1}/{userId2}', [MensajeController::class, 'mostrarMensajeEntreEllos']);
Route::get('/ultim-missatge/{userId1}/{userId2}', [MensajeController::class, 'mostrarUltimoMensajeEntreEllos']);

Route::get('/exercicis', [EjercicioController::class, 'getEjercicios']);

Route::get('/rutina/{id}', [RutinaController::class, 'getRutina']);
Route::get('/rutina-id/{id}', [RutinaController::class, 'getRutinaId']);

Route::post('/guardar-rutina', [RutinaController::class, 'store']);

Route::get('/aliments', [AlimentsController::class, 'index']);

Route::get('/dietas', [DietaController::class, 'getDietas']);
Route::get('/dieta/{id}', [DietaController::class, 'getDieta']);
Route::get('/dietas/{id}', [DietaController::class, 'mostrarDietasUsuario']);
Route::post('/guardar-dieta', [DietaController::class, 'store']);

Route::post('/registre', [UserController::class, 'registre']);
Route::post('/loguejat', [UserController::class, 'loguejat']);
Route::post('/deslojegat', [UserController::class, 'deslojegat']);

Route::post('/comprovaremail', [UserController::class, 'comprovarCorreuUsuari']);
Route::post('/comprovarnomusuari', [UserController::class, 'comprovarNomUsuari']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
