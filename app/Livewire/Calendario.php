<?php

namespace App\Livewire;

use App\Models\Festivo;
use App\Models\Fichar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendario extends Component
{

    // public $fechaInicio = -1;

    public $empleado = null;

    public $festivos = null;

    #[On(['reset'])]
    public function render()
    {
        $usuario = Fichar::select('fechaInicio', 'fechaFin')->where('user_id', '=', Auth::id())->get();
        $usuario->toArray();
        
        $this->empleado = $usuario;

        $festivos = Festivo::select('nombre', 'dia', 'mes')->get();
        $festivos->toArray();

        $this->festivos = $festivos;

        $eventos = $this->crearEventos();

        return view('livewire.calendario', compact('usuario', 'eventos', 'festivos'));
    }
    
    public function crearEventos() {
        $eventos = array();
        
        foreach($this->empleado as $item) {
            $titulo = "";

            if ($item->fechaFin) {
                $titulo = "Entrada y Salida";
            } else {
                $titulo = "Entrada";
            }

            $eventos[] = [
                'title' => $titulo,
                'start' => \Carbon\Carbon::parse($item->fechaInicio)->format('Y-m-d')
            ];
        }

        $color = "red";
        $anio = Carbon::now()->year;

        foreach($this->festivos as $item) {
            $titulo = "";
            

            $eventos[] = [
                'title' => $item->nombre,
                'start' => \Carbon\Carbon::create($anio, $item->mes, $item->dia),
                'backgroundColor' => $color,
                'allDay' => true,
            ];
        }
        // dd($eventos);
        return $eventos;
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
