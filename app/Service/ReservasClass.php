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

    public function ListaModerador(){
        $datos = $this->consultaDB->ReservaListaModerador();
        return $datos;
    }

    public function ListaHuesped(){
        $datos = $this->consultaDB->ReservaListaHuesped();
        return $datos;
    }
}
