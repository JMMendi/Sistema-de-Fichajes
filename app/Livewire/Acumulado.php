<?php

namespace App\Livewire;

use App\Models\Fichar;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Acumulado extends Component
{
    public int $user_id = -1;

    public $fechaInicio = null;

    public $fechaFin = null;

    public bool $show = false;

    public $fichas;

    public $fechas = [];

    public $empleado = null;

    public function render()
    {
        $usuarios = User::select('id', 'nombre')->get();
        return view('livewire.acumulado', compact('usuarios'));
    }

    public function recogerDatos()
    {
        if ($this->user_id == 1 || $this->fechaInicio == null || $this->fechaFin == null) {
            $this->js("alert('Error, rellene los campos corretamente')");
        } else {
            $this->resetear();
            $fichas = Fichar::select(
                DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas'),
            )
                ->where('user_id', '=', $this->user_id)
                ->where('fechaInicio', '>', $this->fechaInicio)
                ->where('fechaFin', '<', $this->fechaFin)
                ->groupBy('horas')
                ->orderBy('fechaInicio', 'desc')
                ->get();
        }
        $this->fichas = $fichas;

        $this->empleado = User::findOrFail($this->user_id);

        $this->show = true;
    }

    public function resetear()
    {
        $this->fichas = null;
        $this->empleado = null;
        $this->show = false;
    }
}
