<?php

use App\Http\Controllers\Admins\HabitacioneController;
use App\Http\Controllers\Admins\SedeController;
use Illuminate\Support\Facades\Route;


// Sede
Route::controller(SedeController::class)->group(function () {
    Route::get('Sede', 'lista');
    Route::get('Sede/Detalle/{id}', 'detalle');
    Route::post('Sede', 'crear');
    Route::post('Sede/Editar/{id}', 'editar');
    Route::delete('Sede/Eliminar/{id}', 'eliminar');
});

// Habitaciones
Route::controller(HabitacioneController::class)->group(function () {
    Route::get('Habitaciones', 'lista');
    Route::post('Habitaciones', 'crear');
    Route::get('Habitaciones/Buscar/Identificador/{identificador}', 'Bidentificador');
    Route::get('Habitaciones/Buscar/Tipo/{tipo}', 'Btipo');
    Route::post('Habitaciones/Editar/{id}', 'editar');
    Route::delete('Habitaciones/Eliminar/{id}', 'eliminar');
});

// 