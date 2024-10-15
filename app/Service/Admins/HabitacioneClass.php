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

    public function crear($datos){
        $this->consultaDB->HabitacionesCrear($datos);
    }

    public function editar($datos, $id){
        $this->consultaDB->HabitacionesEditar($datos, $id);
    }

    public function identificador($dato){
        $da = $this->consultaDB->HabitacionesIdentificador($dato);
        return $da;
    }

    public function tipo($dato){
        $da = $this->consultaDB->HabitacionesTipo($dato);
        return $da;
    }
}
