<?php

namespace App\Service;

use App\Service\DB\consultasClass;

class UserClass
{
    private $consultaDB;

    public function __construct(consultasClass $consultaDB)
    {
        $this->consultaDB = $consultaDB;
    }
    
    // Listas
        public function listaHuesped(){
            $datos = $this->consultaDB->UserListaHuesped();
            return $datos;
        } 

        public function listaModeradores(){
            $datos = $this->consultaDB->UserListaModeradores();
            return $datos;
        } 

        public function listaAdministradores(){
            $datos = $this->consultaDB->UserListaAdministradores();;
            return $datos;
        } 

    // Crear
        public function crearAdmin($datos){
            $this-> consultaDB->UserCrear($datos, 'Administrador');
        }

        public function crearModerador($datos){
            $this-> consultaDB->UserCrear($datos, 'Moderador');
        }

        public function crearHuesped($datos){
            $this-> consultaDB->UserCrear($datos, 'Huesped');
        }
    // Editar
        public function editarPanel($datos, $id){
           $this->consultaDB->UserEditarPanel($datos, $id); 
        }

        public function editarUni($datos){
            $this->consultaDB->UserEditarUni($datos); 
         }
}
