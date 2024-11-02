<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\MesCantidade;
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

    public function meses(): JsonResponse
    {
        try {
            $Bd = MesCantidade::all();
            $data = []; // Inicializa un arreglo vacío
            foreach ($Bd as $item) {
                $data['mes'][] = $item->mes;  // Agrega el mes a la clave 'label'
                $data['cantidad'][] = $item->cantidad; // Agrega la cantidad a la clave 'data'
            }
            $data['data'] = json_encode($data);
            $respuesta = response()->json([
                'success' => true,
                'datos' => $data,
            ]);
        } catch (\Throwable $th) {
            $respuesta = response()->json([
                'error' => true,
                'msj' => 'Error no en el sistema'
            ]);
        }
        return $respuesta;
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
