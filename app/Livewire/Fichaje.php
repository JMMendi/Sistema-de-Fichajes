<?php

namespace App\Livewire;

use App\Http\Controllers\DashboardController;
use App\Livewire\Forms\FormFichaje;
use App\Models\Fichar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Laravel\Prompts\alert;

class Fichaje extends Component
{
    public bool $abrirFichar = false;
    public FormFichaje $cform;

    public function render()
    {
        $usuarios = User::select('id', 'nombre')->get();

        $prueba = new Fichar();
        $motivos = $prueba->arrayMotivos();
        
        return view('livewire.fichaje', compact('usuarios', 'motivos'));
    }

    public function store() {
        $this->cform->formStoreFichaje();

        $this->dispatch('mensaje', 'Fichaje realizado con éxito');
        $this->dispatch('onCreate')->to(ShowFichas::class);
        $this->cerrarFichar();
    }

    public function cerrarFichar() {
        $this->abrirFichar = false;
        $this->cform->resetear();
    }
}
