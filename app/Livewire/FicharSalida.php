<?php

namespace App\Livewire;

use App\Livewire\Forms\FormFichaje;
use App\Models\Fichar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FicharSalida extends Component
{
    public bool $abrirFicharSalida = false;
    public FormFichaje $cform;
    public $latitude = -1;
    public $longitude = -1;

    public function render()
    {
        $prueba = new Fichar();
        $motivos = $prueba->arrayMotivos();

        return view('livewire.fichar-salida', compact('motivos'));
    }

    public function confirmarSalida()
    {
        $this->cform->formStoreSalida($this->latitude, $this->longitude);

        $this->dispatch('salida')->to(Calendario::class);
        $this->dispatch('mensaje', (Auth::user()->nombre . " ha fichado para salir a las: " . Carbon::now()->format('H:i:s')));
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->abrirFicharSalida = false;
    }
}
