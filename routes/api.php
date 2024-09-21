<?php

use App\Http\Controllers\Admins\HabitacioneController;
use Illuminate\Support\Facades\Route;

// Habitaciones
Route::controller(HabitacioneController::class)->group(function () {
    Route::get('habitaciones', 'lista'); // Devuelve la lista de las habitaciones
    Route::post('habitaciones/verificar', 'verificar'); // verificar si la == esta libre
    Route::get('habitaciones/detalles/{id}', 'detalles'); // devuelve los datos completo de una == 
    Route::post('habitaciones/editar/{id}', 'editar'); // guarda la == en la base de dato
    Route::post('habitaciones', 'crear'); // guarda la == en la base de dato
    Route::delete('habitaciones/eliminar/{id}', 'eliminar'); // elimina la == en la base de dato
});


