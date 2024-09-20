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

    
}
