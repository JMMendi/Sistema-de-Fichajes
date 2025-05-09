<?php

namespace App\Livewire;

use App\Models\Fichar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendario extends Component
{

    // public $fechaInicio = -1;

    public $empleado = null;

    #[On(['reset'])]
    public function render()
    {
        $usuario = Fichar::select('fechaInicio', 'fechaFin')->where('user_id', '=', Auth::id())->get();
        $usuario->toArray();

        $this->empleado = $usuario;

        $eventos = $this->crearEventos();

        // dd($empleado);
        return view('livewire.calendario', compact('usuario', 'eventos'));
    }
    
    public function crearEventos() {
        $eventos = [];
        foreach($this->empleado as $item) {
            $titulo = "";

            if ($item->fechaFin) {
                $titulo = "Entrada y Salida";
            } else {
                $titulo = "Entrada";
            }

            $eventos = array (
                "title" => $titulo,
                "start" => $item->fechaInicio
            );
        }
        $this->js('onEventos', $eventos);
    }
    // #[On('comprobar')]
    // public function comprobarFichaje($fechaInicio) {
    //     $this->fechaInicio = \Carbon\Carbon::parse($fechaInicio)->format('Y-m-d');

    //     $fichaExiste = DB::table('fichars')
    //     ->select('id')
    //     ->where('user_id', '=', Auth::id())
    //     ->whereDate('fechaInicio', '=', $this->fechaInicio)
    //     ->exists();

    //     if (!$fichaExiste) {
    //         $this->js('console.log("No se fichó")');

    //     } else {
    //         $ficha = DB::table('fichars')
    //         ->select('id')
    //         ->where('user_id', '=', Auth::id())
    //         ->whereDate('fechaInicio', '=', $this->fechaInicio)
    //         ->get();

    //         $fichaje = Fichar::findOrFail($ficha[0]->id);

    //         if ($fichaje->fechaFin == null) {
    //             $this->dispatch('mensaje', 'El empleado todavía no ha fichado la salida del horario laboral');

    //         } else {
    //             $this->dispatch('mensaje', 'El empleado fichó este día.');
    //         }
    //     }
    // }
}
