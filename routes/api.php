<?php

use App\Http\Controllers\Admins\HabitacioneController;
use App\Http\Controllers\Admins\SedeController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::post('Login', 'login');
    Route::post('Registro/Huesped', 'registerHuesped'); 
});

// Habitaciones
Route::controller(HabitacioneController::class)->group(function () {
    Route::get('Habitaciones', 'lista');
});

Route::middleware('auth:sanctum')->group(function () {

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
        Route::get('Habitaciones/Cantidad', 'cantidad');
        Route::get('Habitaciones/Moderador', 'listaModeradro');
        Route::get('Habitaciones/Detalle/{id}', 'detalle');
        Route::post('Habitaciones', 'crear');
        Route::post('Habitaciones/Editar/{id}', 'editar');
        Route::delete('Habitaciones/Eliminar/{id}', 'eliminar');
    });

    // Users
    Route::controller(UserController::class)->group(function () {
        Route::get('Logout', 'logout');
        Route::get('Huesped/Lista', 'listaHuesped');
        Route::get('Moderador/Lista', 'listaModeradores');
        Route::get('Administrador/Lista', 'listaAdministradores');
        Route::get('User/Detalle/Trabajadores/{id}', 'detalleTrabajadores');
        Route::get('User/Detalle/Huesped/{id}', 'detalleHuesped');
        Route::post('Registro/Moderador', 'registerModerador');
        Route::post('Registro/Administrador', 'registerAdministrador');
        Route::post('User/Editar/{id}', 'editarPanel');
        Route::post('User/EditarUni', 'editarUni');
        Route::delete('User/Eliminar/{id}', 'eliminar');
    });

    // Reservas
    Route::controller(ReservaController::class)->group(function () {
        Route::get('Reservas/Lista/PanelAdmin', 'listaPanelAdmin');
        Route::get('Reservas/Lista/Huesped', 'listaHuesped');
        Route::post('Reservas/Crear', 'reservaCrear');
        Route::post('Reservas/CrearModerador', 'reservaModerador');
        Route::post('Reservas/Editar/{id}', 'reservaModerador');
    });

});
