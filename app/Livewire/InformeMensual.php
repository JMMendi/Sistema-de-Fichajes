<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class InformeMensual extends Component
{
    public function render()
    {
        $usuarios = User::select('id', 'nombre')->get();
        return view('livewire.informe-mensual', compact('usuarios'));
    }


}
