<?php

namespace App\Livewire;

use App\Models\Fichar;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Inicio extends Component
{
    
    #[On(['salida', 'entrada'])]
    public function render()
    {
        $fichaje = Fichar::where('user_id', '=', Auth::id())
        ->where('fechaFin', null)
        ->get();
        return view('livewire.inicio', compact('fichaje'));
    }


}
