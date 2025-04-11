<?php

namespace App\Livewire;

use App\Models\Fichar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

use function Laravel\Prompts\alert;

class Calendario extends Component
{

    public $fechaInicio = -1;

    #[On(['reset'])]
    public function render()
    {
        return view('livewire.calendario');
    }

    #[On('comprobar')]
    public function comprobarFichaje($fechaInicio) {
        $this->fechaInicio = \Carbon\Carbon::parse($fechaInicio)->format('Y-m-d');

        $fichaExiste = DB::table('fichars')
        ->select('id')
        ->where('user_id', '=', Auth::id())
        ->whereDate('fechaInicio', '=', $this->fechaInicio)
        ->exists();

        
        if (!$fichaExiste) {
            $this->dispatch('mensaje', \Carbon\Carbon::parse($fechaInicio)->format('d/M/y')." - El empleado no fichó ese día");

        } else {
            $ficha = DB::table('fichars')
            ->select('id')
            ->where('user_id', '=', Auth::id())
            ->whereDate('fechaInicio', '=', $this->fechaInicio)
            ->get();

            $fichaje = Fichar::findOrFail($ficha[0]->id);

            if ($fichaje->fechaFin == null) {
                $this->dispatch('mensaje', 'El empleado todavía no ha fichado la salida del horario laboral');


            } else {
                $this->dispatch('mensaje', 'El empleado fichó este día.');

                // $this->js("alert('Empleado fichó');"); 
                $this->dispatch('reset')->self();
            }
        }
    }
}
