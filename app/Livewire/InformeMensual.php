<?php

namespace App\Livewire;

use App\Models\Fichar;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InformeMensual extends Component
{
    public int $user_id = -1;

    public $fechaInicio;

    public $fechaFin;

    public bool $show = false;

    public function render()
    {
        $usuarios = User::select('id', 'nombre')->get();
        return view('livewire.informe-mensual', compact('usuarios'));
    }

    public function recogerDatos()
    {
        $fichas = Fichar::select('user_id', 'fechaInicio', 'fechaFin', 'tipo', DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas'))
            ->where('user_id', '=', $this->user_id)
            ->where('fechaInicio', '=>', $this->fechaInicio)
            ->where('fechaFin', '<=', $this->fechaFin)
            ->orderBy('fechaInicio', 'desc')
            ->get();

            $this->show = true;

        $this->dispatch('informeCreado', fichas: $fichas)->to(Informe::class);
        
    }
}
