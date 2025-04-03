<?php

namespace App\Livewire;

use App\Livewire\Forms\FormFichaje;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FicharSalida extends Component
{
    public bool $abrirFicharSalida = false;
    public FormFichaje $cform;

    public function render()
    {
        return view('livewire.fichar-salida');
    }

    public function confirmarSalida()
    {
        $this->cform->formStoreSalida();

        $this->dispatch('salida')->to(Inicio::class);
        $this->dispatch('mensaje', (Auth::user()->nombre . " ha fichado para salir a las: " . Carbon::now()->format('H:i:s')));
        $this->cerrarModal();
    }

    public function cerrarModal()
    {
        $this->abrirFicharSalida = false;
    }
}
