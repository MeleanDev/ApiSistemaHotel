<?php

namespace App\Service\DB;

use App\Models\Habitacione;
use App\Models\Sede;
use App\Models\Ubicacione;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class consultasClass
{
    // Propio
        // Buscar datos del usuario auth
        public function buscarAuth(){
            $id = auth::user()->getAuthIdentifier();
            $usu = User::find($id);
            return $usu;
        }
    // Sede
        // Lista
        public function SedesLista()
        {
            $datos = Sede::with('ubicacione')->get();
            return $datos;
        }

        // Crear
        public function SedesCrear($datos)
        {
            $sede = new Sede();
            $sede->nombre = $datos['nombre'];
            $sede->save();

            $ubi = new Ubicacione();
            $ubi->pais = $datos['pais'];
            $ubi->estado = $datos['estado'];
            $ubi->municipio = $datos['municipio'];
            $ubi->direccion = $datos['direccion'];
            $ubi->sede()->associate($sede);
            $ubi->save();
        }

        // Editar
        public function SedesEditar($datos, $id)
        {
            $id->nombre = $datos['nombre'];
            $id->Ubicacione->pais = $datos['pais'];
            $id->Ubicacione->estado = $datos['estado'];
            $id->Ubicacione->municipio = $datos['municipio'];
            $id->Ubicacione->direccion = $datos['direccion'];
            $id->Ubicacione->save();
            $id->save();
        }

        // Detalle
        public function SedeDetalle($id)
        {
            $datos = Sede::with('ubicacione')->find($id);
            return $datos;
        }

    // Habitaciones
        // Lista
        public function HabitacionesLista()
        {
            $datos = Habitacione::with('sede')->get();
            return $datos;
        }

        // Crear
        public function HabitacionesCrear($datos)
        {
            $authUser = $this->buscarAuth();
            $habi = new Habitacione();
            $habi->identificador = $datos['identificador'];
            $habi->piso = $datos['piso'];
            $habi->tipo = $datos['tipo'];
            $habi->disponibilidad = $datos['disponibilidad'];
            $habi->numPersonas = $datos['numPersonas'];
            $habi->precio = $datos['precio'];
            $habi->sede_id = $authUser->sede_id;
            $habi->save();
        }

        // editar
        public function HabitacionesEditar($datos, $id)
        {
            $id->identificador = $datos['identificador'];
            $id->piso = $datos['piso'];
            $id->tipo = $datos['tipo'];
            $id->disponibilidad = $datos['disponibilidad'];
            $id->numPersonas = $datos['numPersonas'];
            $id->precio = $datos['precio'];
            $id->save();
        }

    // Users
        // Lista
        public function UserListaHuesped(){
            $datos = User::where('tipo', 'Huesped')->get();
            return $datos;
        }

        public function UserListaModeradores(){
            $datos = User::where('tipo', 'Moderador')->get();
            return $datos;
        }

        public function UserListaAdministradores(){
            $datos = User::where('tipo', 'Administrador')->get();
            return $datos;
        }

        // Crear
        public function UserCrear($datos, $rol)
        {
            $admin = new User();
            $admin->nombre = $datos['nombre'];
            $admin->apellido = $datos['apellido'];
            $admin->identificacion = $datos['identificacion'];
            $admin->telefono = $datos['telefono'];
            $admin->email = $datos['email'];
            $admin->password = Hash::make($datos['password']);
            $admin->tipo = $rol;
            if ($datos['sede_id'] == true) {
                $admin->sede()->associate($datos['sede_id']);
            }
            $admin->save();
        }

        // EditarPanel
        public function UserEditarPanel($datos, $id){
            $id->nombre = $datos['nombre'];
            $id->apellido = $datos['apellido'];
            $id->identificacion = $datos['identificacion'];
            $id->telefono = $datos['telefono'];
            $id->email = $datos['email'];
            $id->password = Hash::make($datos['password']);
            $id->save();
        }

        // EditarNormal
        public function UserEditarUni($datos){
            $authUser = $this->buscarAuth();
            $authUser->nombre = $datos['nombre'];
            $authUser->apellido = $datos['apellido'];
            $authUser->identificacion = $datos['identificacion'];
            $authUser->telefono = $datos['telefono'];
            $authUser->email = $datos['email'];
            $authUser->password = Hash::make($datos['password']);
            $authUser->save();
        }


}
