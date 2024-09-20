<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Habitaciones\HabitacioneCrearRequest;
use App\Service\Admins\HabitacioneClass;
use Illuminate\Http\JsonResponse;

class HabitacioneController extends Controller
{
    private $HabitacioneClass;

    public function __construct(HabitacioneClass $HabitacioneClass)
    {
        $this->HabitacioneClass = $HabitacioneClass;
    }

    public function lista():JsonResponse
    {
        $datos = $this->HabitacioneClass->lista();
        if ($datos->isEmpty()) {
            return response()->json(['msj' => 'No se encuentran registros'], 200);
        }
        return response()->json(['msj' => $datos], 200);
    }

    public function crear(HabitacioneCrearRequest $datos): JsonResponse
    {
        $Identificador = $datos->input('Identificador');
        try {
            $verificacion = $this->HabitacioneClass->verificacion($Identificador);
            if ($verificacion === true) {
                $this->HabitacioneClass->crear($Identificador);
                $repuesta = response()->json([
                    'msj' => 'Habitacion '.$Identificador.' agregada.',
                ]);
            }else {
                $repuesta = response()->json([
                    'msj' => 'Habitacion no agregada porque ya existe.'
                ]);
            }
        } catch (\Throwable $th) {
            $repuesta = response()->json([
                'msj' => 'No se pudo agregar la habitacion por falla en el sistema.'
            ]);
        }
        return $repuesta;
    }

    

}
