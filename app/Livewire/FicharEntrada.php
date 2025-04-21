<?php

namespace App\Livewire;

use App\Livewire\Forms\FormFichaje;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FicharEntrada extends Component
{
    public bool $abrirFicharEntrada = false;
    public FormFichaje $cform;
    public $latitude = -1;
    public $longitude = -1;

    public function render()
    {
        return view('livewire.fichar-entrada');
    }

    public function confirmarEntrada() {
        $this->cform->formStoreEntrada($this->latitude, $this->longitude);
        
        $this->dispatch('entrada')->to(Calendario::class);
        $this->dispatch('mensaje', (Auth::user()->nombre." ha fichado para entrar a las: ".Carbon::now()->format('H:i:s')));
        $this->cerrarModal();
    }


    public function cerrarModal() {
        $this->abrirFicharEntrada = false;
    }
}
