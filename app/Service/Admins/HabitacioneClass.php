<?php

namespace App\Service\Admins;

use App\Service\DB\ConsultasDB;

class HabitacioneClass
{
    private $ConsultasDB;

    public function __construct(ConsultasDB $ConsultasDB)
    {
        $this->ConsultasDB = $ConsultasDB;
    }

    public function lista(){
        $datos = $this->ConsultasDB->HabitacionesLista();
        return $datos;
    }

    public function verificacion($dato){
        $verifica = $this->ConsultasDB->HabitacionesBuscar($dato);
        if ($verifica == true) {
            return false;
        }
        return true;
    }

    public function crear($dato){
        $this->ConsultasDB->HabitacionesCrear($dato);
    }

    
}
