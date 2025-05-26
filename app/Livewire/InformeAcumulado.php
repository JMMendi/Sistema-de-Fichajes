<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class InformeAcumulado extends Component
{
    public $fichas;

    public function render($fichas)
    {
        $empleado = User::findOrFail($fichas[0]->user_id);

        return view('livewire.informe-acumulado', compact('fichas', 'empleado'));
    }
}
