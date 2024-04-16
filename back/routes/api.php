<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/usuari', [UserController::class, 'usuari']);
Route::get('/usuari/{id}', [UserController::class, 'usuariId']);
Route::post('/editar-usuari{id}', [UserController::class, 'editarUsuari']);
Route::post('/registre', [UserController::class, 'registre']);
Route::post('/loguejat', [UserController::class, 'loguejat']);
Route::post('/deslojegat', [UserController::class, 'deslojegat']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
