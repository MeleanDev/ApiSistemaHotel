<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Habitaciones\HabitacioneCrearRequest;
use App\Http\Requests\Admins\Habitaciones\HabitacioneEditarRequest;
use App\Models\Habitacione;
use App\Service\Admins\HabitacioneClass;
use Illuminate\Http\JsonResponse;

class HabitacioneController extends Controller
{
    private $HabitacioneClass;

    public function __construct(HabitacioneClass $HabitacioneClass)
    {
        $this->HabitacioneClass = $HabitacioneClass;
    }

    public function lista(): JsonResponse
    {
        try {
            $datos = $this->HabitacioneClass->lista();
            if ($datos->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'msj' => 'No se encuentran registros'
                ], 200);
            }
            return response()->json([
                'success' => true,
                'msj' => $datos
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errorSistema' => true,
                'msj' => 'Falla en el sistema contacte con un administrador.'
            ], 500);
        }
    }

    public function verificar(HabitacioneCrearRequest $datos): JsonResponse
    {
        $Identificador = $datos->input('Identificador');
        try {
            $verificacion = $this->HabitacioneClass->verificacion($Identificador);
            if ($verificacion === true) {
                $repuesta = response()->json([
                    'success' => true,
                    'msj' => 'Identificador ' . $Identificador . ', libre para guardar.',
                ], 200);
            } else {
                $repuesta = response()->json([
                    'error' => true,
                    'msj' => 'Identificador ' . $Identificador . ', ya esta en uso.',
                ], 200);
            }
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'errorSistema' => true,
                'msj' => 'Falla en el sistema contacte con un administrador.'
            ], 500);
        }
        return $repuesta;
    }

    public function crear(HabitacioneCrearRequest $datos): JsonResponse
    {
        $Identificador = $datos->input('Identificador');
        try {
            $this->HabitacioneClass->crear($Identificador);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Habitacion ' . $Identificador . ' agregada.',
            ], 201);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'errorSistema' => true,
                'msj' => 'Falla en el sistema contacte con un administrador.'
            ], 500);
        }
        return $repuesta;
    }

    public function detalles(Habitacione $id): JsonResponse
    {
        return response()->json([
            $id
        ],200);
    }

    public function editar(HabitacioneEditarRequest $datos, Habitacione $id): JsonResponse
    {
        try {
            $this->HabitacioneClass->editar($id, $datos);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Datos editado con exito',
            ], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'errorSistema' => true,
                'msj' => 'Falla en el sistema contacte con un administrador.'
            ], 500);
        }
        return $repuesta;
    }

    public function eliminar(Habitacione $id): JsonResponse
    {
        try {
            $this->HabitacioneClass->eliminar($id);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Habitacion eliminada.',
            ], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'errorSistema' => true,
                'msj' => 'Falla en el sistema contacte con un administrador.'
            ],500);
        }
        return $repuesta;
    }

}
