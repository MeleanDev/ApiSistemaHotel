<?php

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

// 