<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProyectoController;
use App\Http\Controllers\API\BloqueController;
use App\Http\Controllers\API\PiezaController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['web', 'auth'])->group(function () {
    // API Resources para CRUD completo
    Route::apiResource('proyectos', ProyectoController::class);
    Route::apiResource('bloques', BloqueController::class);
    Route::apiResource('piezas', PiezaController::class);

    // Rutas especiales para formulario dinámico
    Route::get('/bloques/proyecto/{proyectoId}', [BloqueController::class, 'byProyecto']);
    Route::get('/piezas/bloque/{bloqueId}', [PiezaController::class, 'byBloque']);
});
