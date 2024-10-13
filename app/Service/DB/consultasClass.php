<?php

namespace App\Service\DB;

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
}
