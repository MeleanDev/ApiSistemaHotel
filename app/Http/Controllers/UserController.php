<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\UserClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $usersClass;

    public function __construct(UserClass $usersClass)
    {
        $this->usersClass = $usersClass;
    }

    public function login(LoginRequest $datos){
        if (!Auth::attempt($datos->only('email', 'password'))) {
            return response()->json([
                'mensaje' => 'Usuario No Logiado'
            ], 400);
        }

        $email = User::where('email', $datos->email)->firstOrFail();
        $token = $email->createToken('auth_token')->plainTextToken;

        return response()->json([
            'mensaje' => 'Usurio logiado',
            'usuario' => $email->nombre.' '.$email->apellido ,
            'rol' => $email->tipo,
            'accessToken' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return ['mensaje' => 'Logout Exitoso'];
    }

    // Listas
        // ListaHuesped
        public function listaHuesped()
        {
            $datos = $this->usersClass->listaHuesped();
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
                    'huesped' => $datos
                ],
                200
            );
        }

        // ListaModerador
        public function listaModeradores()
        {
            $datos = $this->usersClass->listaModeradores();
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
                    'moderadores' => $datos
                ],
                200
            );
        }

        // ListaAdmins
        public function listaAdministradores()
        {
            $datos = $this->usersClass->listaAdministradores();
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
                    'administradores' => $datos
                ],
                200
            );
        }
    
    // Detalle
        public function detalleTrabajadores($id): JsonResponse
        {
            try {
                $datos = User::with('sede')->find($id);
                $respuesta = response()->json([
                    'success' => true,
                    'user' => $datos
                ]);
            } catch (\Throwable $th) {
                $respuesta = response()->json([
                    'error' => true,
                    'msj' => 'No se encontro User con ese id'
                ]);
            }
            return $respuesta;
        }

        public function detalleHuesped(user $id): JsonResponse
        {
            try {
                $respuesta = response()->json([
                    'success' => true,
                    'user' => $id
                ]);
            } catch (\Throwable $th) {
                $respuesta = response()->json([
                    'error' => true,
                    'msj' => 'No se encontro User con ese id'
                ]);
            }
            return $respuesta;
        }
    // Crear
    public function registerHuesped(UserRequest $datos): JsonResponse
    {
        try {
            $this->usersClass->crearHuesped($datos);
            return response()->json([
                'success' => true,
                'mensaje' => 'Usuario Creado con exito'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error en la creacion, Verifica los datos'
            ], 400);
        }
    }

    public function registerModerador(UserRequest $datos): JsonResponse
    {
        try {
            $this->usersClass->crearModerador($datos);
            return response()->json([
                'success' => true,
                'mensaje' => 'Usuario Creado con exito'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error en la creacion, Verifica los datos'
            ], 400);
        }
    }

    public function registerAdministrador(UserRequest $datos): JsonResponse
    {
        try {
            $this->usersClass->crearAdmin($datos);
            return response()->json([
                'success' => true,
                'mensaje' => 'Usuario Creado con exito'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error en la creacion, Verifica los datos'
            ], 400);
        }
    }


    // Modificar 
    // Editar desde el panel
    public function editarPanel(UserRequest $datos, User $id): JsonResponse
    {
        try {
            $this->usersClass->editarPanel($datos, $id);
            $dato = $id;
            return response()->json([
                'success' => true,
                'msj' => 'Usuario Modificado'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'msj' => 'Error al modificar usuario'
            ]);
        }
    }

    // Editar unicoPropio
    public function editarUni(UserRequest $datos): JsonResponse
    {
        try {
            $this->usersClass->editarUni($datos);
            return response()->json([
                'success' => true,
                'msj' => 'Usuario Modificado'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'msj' => 'Error al modificar usuario'
            ]);
        }
    }

    // eliminar
    public function eliminar(User $id): JsonResponse
    {
        $id->delete();
        return response()->json([
            'success' => true,
            'msj' => 'Usuario eliminado'
        ]);
    }
}
