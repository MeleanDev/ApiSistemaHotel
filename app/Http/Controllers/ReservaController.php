<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Reserva;
use App\Service\ReservasClass;
use Illuminate\Http\JsonResponse;

class ReservaController extends Controller
{
    private $reservaClass;

    public function __construct(ReservasClass $reservaClass)
    {
        $this->reservaClass = $reservaClass;
    }

    public function listaPanelAdmin(): JsonResponse
    {
        $datos = $this->reservaClass->ListaAdmin();
            if ($datos->isEmpty()) {
                return response()->json(
                    [
                        'success' => true,
                        'msj' => 'No se encuentran registros'
                    ],
                    200
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'reservas' => $datos
                ],
                200
            );
    }

    public function listaPanelModerador(): JsonResponse
    {   
        $datos = $this->reservaClass->ListaModerador();
            if ($datos->isEmpty()) {
                return response()->json(
                    [
                        'success' => true,
                        'msj' => 'No se encuentran registros'
                    ],
                    200
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'reservas' => $datos
                ],
                200
            );
    }

    public function listaHuesped(): JsonResponse
    {
        $datos = $this->reservaClass->ListaHuesped();
            if ($datos->isEmpty()) {
                return response()->json(
                    [
                        'success' => true,
                        'msj' => 'No se encuentran registros'
                    ],
                    200
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'reservas' => $datos
                ],
                200
            );
    }

    public function reservaCrear(ReservaRequest $datos): JsonResponse
    {
        try {
            $this->reservaClass->crear($datos);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Reserva creada con exito'
            ]);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => true,
                'msj' => 'Reserva No creada'
            ]);
        }

       return $repuesta;
    }

    public function reservaModerador(ReservaRequest $datos): JsonResponse
    {
        try {
            $this->reservaClass->crearTrabajador($datos);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Reserva creada con exito'
            ]);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => true,
                'msj' => 'Reserva No creada'
            ]);
        }

       return $repuesta;
    }

    public function editar(ReservaRequest $datos, Reserva $id): JsonResponse
    {
        try {
            $this->reservaClass->editar($datos, $id);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Datos editados con exito'
            ]);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => true,
                'msj' => 'Datos no editados'
            ]);
        }

        return $repuesta;
    }
}
