<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\personaController;
use App\Http\Controllers\persona_escuelaController;
use App\Http\Controllers\escuelasController;
use App\Http\Controllers\canjesController;
use App\Http\Controllers\recompensaController;
use App\Http\Controllers\materialController;
use App\Http\Controllers\puntosController;
//Usuarios:
Route::get('/usuario', [usuarioController::class, 'index']);
Route::post('/usuario', [usuarioController::class, 'store']);


//Persona:
Route::get('/persona', [personaController::class, 'index']);
Route::post('/persona', [personaController::class, 'store']);

//Persona_escuela:
Route::get('/persona_escuela', [persona_escuelaController::class, 'index']);
Route::post('/persona_escuela', [persona_escuelaController::class, 'store']);

//Escuelas:
Route::get('/escuelas', [escuelasController::class, 'index']);
Route::post('/escuelas', [escuelasController::class, 'store']);

//Canjes:
Route::get('/canjes', [canjesController::class, 'index']);
Route::post('/canjes', [canjesController::class, 'store']);

//Recompensa:
Route::get('/recompensa', [recompensaController::class, 'index']);
Route::post('/recompensa', [recompensaController::class, 'store']);

//Material:
Route::get('/material', [materialController::class, 'index']);
Route::post('/material', [materialController::class, 'store']);

//Puntos:
Route::get('/puntos', [puntosController::class, 'index']);
Route::post('/puntos', [puntosController::class, 'store']);

Route::put('/usuario', function () {
    return 'Obteniendo usuarios';
});

Route::put('/usuario/{idUsuario}', function () {
    return 'Actualizando usuario por id';
});
