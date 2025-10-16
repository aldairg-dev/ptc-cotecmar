<?php

use App\Http\Controllers\MinuciaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\API\BloqueController;
use App\Http\Controllers\API\PiezaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [MinuciaController::class, 'index'])->name('dashboard');

    // API endpoints para formularios dinámicos
    Route::get('/api/bloques/proyecto/{proyectoId}', [BloqueController::class, 'byProyecto']);
    Route::get('/api/piezas/bloque/{bloqueId}', [PiezaController::class, 'byBloque']);

    Route::prefix('minucia')->name('minucia.')->group(function () {
        Route::get('/', [MinuciaController::class, 'index'])->name('index');
        Route::get('/registro', [MinuciaController::class, 'create'])->name('create');
        Route::post('/registro', [MinuciaController::class, 'store'])->name('store');
        Route::get('/registros', [MinuciaController::class, 'registros'])->name('registros');
        Route::get('/registros/{id}', [MinuciaController::class, 'show'])->name('show');
        Route::get('/registros/{id}/editar', [MinuciaController::class, 'edit'])->name('edit');
        Route::put('/registros/{id}', [MinuciaController::class, 'update'])->name('update');
        Route::delete('/registros/{id}', [MinuciaController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/piezas-pendientes', [ReporteController::class, 'piezasPendientes'])->name('piezas-pendientes');
        Route::get('/grafico-proyectos', [ReporteController::class, 'graficoProyectos'])->name('grafico-proyectos');
    });
});
