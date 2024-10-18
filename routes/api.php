<?php

use App\Http\Controllers\Admins\HabitacioneController;
use App\Http\Controllers\Admins\SedeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->group(function () {

    // Sede
    Route::controller(SedeController::class)->group(function () {
        Route::get('Sede', 'lista');
        Route::post('Sede', 'crear');
        Route::get('Sede/Detalle/{id}', 'detalle');
        Route::post('Sede/Editar/{id}', 'editar');
        Route::delete('Sede/Eliminar/{id}', 'eliminar');
    });

    // Habitaciones
    Route::controller(HabitacioneController::class)->group(function () {
        Route::get('Habitaciones', 'lista');
        Route::post('Habitaciones', 'crear');
        Route::post('Habitaciones/Editar/{id}', 'editar');
        Route::delete('Habitaciones/Eliminar/{id}', 'eliminar');
    });

    // Users
    Route::controller(UserController::class)->group(function () {
        Route::get('Huesped/Lista', 'listaHuesped');
        Route::get('Moderador/Lista', 'listaModeradores');
        Route::get('Administrador/Lista', 'listaAdministradores');
        Route::post('Registro/Huesped', 'registerHuesped');
        Route::post('Registro/Moderador', 'registerModerador');
        Route::post('Registro/Administrador', 'registerAdministrador');
        Route::post('User/Editar/{id}', 'editarPanel');
        Route::post('User/EditarUni', 'editarUni');
        Route::delete('User/Eliminar/{id}', 'eliminar');
    });

    // Reservas

// });
