<?php

use App\Http\Controllers\Admins\HabitacioneController;
use Illuminate\Support\Facades\Route;

// Habitaciones
Route::controller(HabitacioneController::class)->group(function () {
    Route::get('habitaciones', 'lista');
    Route::post('habitaciones', 'crear');
});


