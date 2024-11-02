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

    public function listaModerador(): JsonResponse
    {
        $datos = $this->habitacioneClass->listaModerador();
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

    public function cantidad(): JsonResponse
    {
        try {
            $Totales = Habitacione::count();
            $Disponibles = Habitacione::where('estado', 'S')->count();
            $Ocupadas = Habitacione::where('estado', 'N')->count();

            $respuesta = response()->json([
                'success' => true,
                'Totales' => $Totales,
                'Disponibles' => $Disponibles,
                'Ocupadas' => $Ocupadas,
            ]);
        } catch (\Throwable $th) {
            $respuesta = response()->json([
                'error' => true,
                'msj' => 'Error no en el sistema'
            ]);
        }
        return $respuesta;
    }

    public function detalle($id): JsonResponse
    {
        try {
            $datos = Habitacione::with('sede')->find($id);
            $respuesta = response()->json([
                'success' => true,
                'habitacion' => $datos
            ]);
        } catch (\Throwable $th) {
            $respuesta = response()->json([
                'error' => true,
                'msj' => 'No se encontro habitacion con ese id'
            ]);
        }
        return $respuesta;
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
}
