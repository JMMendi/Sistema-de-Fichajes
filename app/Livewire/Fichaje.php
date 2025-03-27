<?php

namespace App\Livewire;

use App\Http\Controllers\DashboardController;
use App\Livewire\Forms\FormFichaje;
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
        $usuario = Auth::user()->id;
        
        return view('livewire.fichaje', compact('usuario', 'usuarios'));
    }

    public function store() {
        $this->cform->formStoreFichaje();

        $this->dispatch('mensaje', 'Fichaje realizado con éxito');
        $this->cerrarFichar();
    }

    public function cerrarFichar() {
        $this->abrirFichar = false;
        $this->cform->resetear();
    }
}
