<?php

namespace App\Http\Controllers;

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

}
