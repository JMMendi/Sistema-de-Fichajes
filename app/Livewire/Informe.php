<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Informe extends Component
{
    public $fichas;

    
    #[On('informeCreado')]
    public function render($fichas)
    {
        $empleado = User::findOrFail($fichas[0]->user_id);
        return view('livewire.informe', compact('fichas', 'empleado'));
    }
}
