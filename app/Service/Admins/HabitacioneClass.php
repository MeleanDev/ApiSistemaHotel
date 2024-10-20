<?php

namespace App\Service\Admins;

use App\Service\DB\consultasClass;

class HabitacioneClass
{
    private $consultaDB;

    public function __construct(consultasClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }

    public function lista(){
        $datos = $this->consultaDB->HabitacionesLista();
        return $datos;
    }

    public function listaModerador(){
        $datos = $this->consultaDB->HabitacionesListaModerador();;
        return $datos;
    }

    public function crear($datos){
        $this->consultaDB->HabitacionesCrear($datos);
    }

    public function editar($datos, $id){
        $this->consultaDB->HabitacionesEditar($datos, $id);
    }
}
