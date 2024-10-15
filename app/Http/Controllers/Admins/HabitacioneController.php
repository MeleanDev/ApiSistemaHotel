<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\HabitacionRequest;
use App\Models\Habitacione;
use App\Service\Admins\HabitacioneClass;
use Illuminate\Http\JsonResponse;

class HabitacioneController extends Controller
{
    private $habitacioneClass;

    public function __construct(HabitacioneClass $habitacioneClass)
    {
        $this->habitacioneClass = $habitacioneClass;
    }

    public function lista(): JsonResponse
    {
        $datos = $this->habitacioneClass->lista();
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
                'Habitaciones' => $datos
            ],
            200
        );
    }

    public function crear(HabitacionRequest $datos): JsonResponse
    {
        try {
            $this->habitacioneClass->crear($datos);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Habitacion Creada con exito'
            ], 201);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => false,
                'msj' => 'Error en los datos'
            ], 400);
        }
        return $repuesta;
    }

    public function editar(HabitacionRequest $datos, Habitacione $id)
    {
        try {
            $this->habitacioneClass->editar($datos, $id);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Datos de la habitacion editados con exito'
            ], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => false,
                'msj' => 'Error en la Modificacion'
            ], 400);
        }
        return $repuesta;
    }

    public function eliminar(Habitacione $id): JsonResponse
    {
        $id->delete();
        return response()->json([
            'success' => true,
            'msj' => 'Habitacion eliminada'
        ]);
    }

    public function Bidentificador($identificador): JsonResponse
    {
        $datos = $this->habitacioneClass->identificador($identificador);
        if($datos == null) $datos = "No existe ninguna habitacion con ese Identificador";
        return response()->json([
            'success' => true,
            'Habitacion' => $datos
        ], 200);
    }

    public function Btipo($tipo): JsonResponse
    {
        $datos = $this->habitacioneClass->tipo($tipo);
        if ($datos->isEmpty()) {
            return response()->json(
                [
                    'error' => true,
                    'msj' => 'No hay habitaciones de ese tipo'
                ],
                200
            );
        }
        return response()->json(
            [
                'success' => true,
                'Habitaciones' => $datos
            ],
            200
        );
    }
}
