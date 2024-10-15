<?php

namespace App\Service\DB;

use App\Models\Habitacione;
use App\Models\Sede;
use App\Models\Ubicacione;

class consultasClass
{
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
        public function HabitacionesLista(){
            $datos = Habitacione::with('sede')->get();
            return $datos;
        }

        // Crear
        public function HabitacionesCrear($datos){
            $habi = new Habitacione();
            $habi->identificador = $datos['identificador'];
            $habi->piso = $datos['piso'];
            $habi->tipo = $datos['tipo'];
            $habi->disponibilidad = $datos['disponibilidad'];
            $habi->numPersonas = $datos['numPersonas'];
            $habi->precio = $datos['precio'];
            $habi->sede_id = $datos['sede_id'];
            $habi->save();
        }

        // editar
        public function HabitacionesEditar($datos, $id){
            $id->identificador = $datos['identificador'];
            $id->piso = $datos['piso'];
            $id->tipo = $datos['tipo'];
            $id->disponibilidad = $datos['disponibilidad'];
            $id->numPersonas = $datos['numPersonas'];
            $id->precio = $datos['precio'];
            $id->sede_id = $datos['sede_id'];
            $id->save();
        }

        // Buscar por identificador
        public function HabitacionesIdentificador($dato){
            $habitacion = Habitacione::where('identificador', $dato)->with('sede')->first();
            return $habitacion;
        }

        // Buscar por Tipo
        public function HabitacionesTipo($dato){
            $habitacion = Habitacione::where('tipo', $dato)->with('sede')->get();
            return $habitacion;
        }
}
