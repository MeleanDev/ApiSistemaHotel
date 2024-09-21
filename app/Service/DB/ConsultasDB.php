<?php

namespace App\Service\DB;

use App\Models\Habitacione;

class ConsultasDB
{
// Habitaciones
    // Lista 
    public function HabitacionesLista(){
        $datos = Habitacione::all();
        return $datos;
    }

    // Busca 
    public function HabitacionesBuscar($dato){
        $repuesta = Habitacione::where('Identificador', $dato)->first();
        return $repuesta;
    }

    // Crear 
    public function HabitacionesCrear($dato){
        $habita = new Habitacione();
        $habita->Identificador = $dato;
        $habita->save();
    }

    // Editar
    public function HabitacionesEditar($id, $datos){
        $id->Piso = $datos->input('Piso');
        $id->Tipo = $datos->input('Tipo');
        $id->Disponibilidad = $datos->input('Disponibilidad');
        $id->NumPersonas = $datos->input('NumPersonas');
        $id->save();
    }

    // Eliminar
    public function HabitacionesEliminar($id){
        $id->delete();
    }
}
