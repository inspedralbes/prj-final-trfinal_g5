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

Route::get('/tots-usuaris', [UserController::class, 'listarUsuaris']);
Route::delete('/eliminar-usuari/{id}', [UserController::class, 'eliminarUsuari']);
Route::get('/usuaris', [UserController::class, 'getUsers']);
Route::get('/usuari/{id}', [UserController::class, 'mostrarUsuario']);
Route::put('/editar-usuari/{id}', [UserController::class, 'editarUsuari']);
Route::get('/chatUsuaris/{id}', [UserController::class, 'getAmics']);
Route::get('/usuarios-excepto/{idUsuario}', [UserController::class, 'mostrarUsuariosExceptoYo']);
Route::post('/registre', [UserController::class, 'registre']);
Route::post('/loguejat', [UserController::class, 'loguejat']);
Route::post('/deslojegat', [UserController::class, 'deslojegat']);
Route::post('/comprovaremail', [UserController::class, 'comprovarCorreuUsuari']);
Route::post('/comprovarnomusuari', [UserController::class, 'comprovarNomUsuari']);


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
Route::post('/guardar-rutina', [RutinaController::class, 'store']);
Route::delete('/eliminar-rutina/{id}', [RutinaController::class, 'destroyTodo']);
Route::delete('/eliminar-rutina-hoy/{id}', [RutinaController::class, 'destroyToday']);
Route::delete('/rutinas/{id_usuari}/{fecha}', [RutinaController::class, 'destroyByDate']); 
// Route::delete('/eliminar-rutina/{id}', [RutinaController::class, 'destroy']);
Route::post('/descargarRutina', [RutinaController::class, 'saveRoutines']);


Route::get('/aliments', [AlimentsController::class, 'index']);



Route::get('/dieta/{id}', [DietaController::class, 'getDietas']);
Route::post('/guardar-dieta', [DietaController::class, 'store']);
// Route::delete('/eliminar-dieta/{id}', [DietaController::class, 'destroy']);
Route::delete('/eliminar-dieta-hoy/{id}', [DietaController::class, 'destroyToday']);
Route::delete('/dietas/{id_usuari}/{fecha}', [DietaController::class, 'destroyByDate']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
