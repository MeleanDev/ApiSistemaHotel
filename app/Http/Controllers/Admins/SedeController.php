<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\SedeRequest;
use App\Models\Sede;
use App\Service\Admins\SedeClass;
use Illuminate\Http\JsonResponse;

class SedeController extends Controller
{
    private $sedeClass;

    public function __construct(SedeClass $sedeClass)
    {
        $this->sedeClass = $sedeClass;
    }

    public function lista(): JsonResponse
    {
        $datos = $this->sedeClass->lista();
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
                'Sedes' => $datos
            ],
            200
        );
    }

    public function crear(SedeRequest $datos): JsonResponse
    {
        try {
            $this->sedeClass->crear($datos);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Sede Creada con exito'
            ], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => false,
                'msj' => 'Error en los datos'
            ], 400);
        }
        return $repuesta;
    }

    public function detalle(Sede $id): JsonResponse
    {
        $datos = $this->sedeClass->detalle($id);
        return response()->json([
            'success' => true,
            'sede' => $datos],
            200);
    }

    public function editar(SedeRequest $datos, Sede $id): JsonResponse
    {
        try {
            $this->sedeClass->editar($datos, $id);
            $repuesta = response()->json([
                'success' => true,
                'msj' => 'Datos de la sede editados con exito'
            ], 200);
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'error' => false,
                'msj' => 'Error en la Modificacion'
            ], 400);
        }
        return $repuesta;
    }

    public function eliminar(Sede $id): JsonResponse
    {
        $id->delete();
        return response()->json([
            'success' => true,
            'msj' => 'Sede eliminada'
        ]);
    }
}
