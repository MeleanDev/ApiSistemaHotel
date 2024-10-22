<?php

namespace App\Service;

use App\Service\DB\consultasClass;

class ReservasClass
{
    private $consultaDB;

    public function __construct(consultasClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function ListaAdmin(){
        $datos = $this->consultaDB->ReservaListaAdmin();
        return $datos;
    }

    public function ListaHuesped(){
        $datos = $this->consultaDB->ReservaListaHuesped();
        return $datos;
    }

    public function crear($datos){
        $this->consultaDB->ReservaCrear($datos);
    }

    public function crearTrabajador($datos){
        $this->consultaDB->ReservaCrearTrabajador($datos);
    }

    public function editar($datos, $id){
        if ($datos['estado'] == true && $datos['estado'] == 'activa') {
            $this->consultaDB->disponibilidad($datos['habitacione_id'], 'N');
        }

        if ($datos['estado'] == true && $datos['terminada'] == 'terminada') {
            $this->consultaDB->disponibilidad($datos['habitacione_id'], 'S');
        }

        if ($datos['estado'] == true && $datos['cancelada'] == 'cancelada') {
            $this->consultaDB->disponibilidad($datos['habitacione_id'], 'S');
        }

        $this->consultaDB->ReservaEditar($datos, $id);
    }
}
