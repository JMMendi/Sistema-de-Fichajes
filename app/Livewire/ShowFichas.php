<?php

namespace App\Livewire;

use App\Models\Fichar;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowFichas extends Component
{
    public function render()
    {
        $fichas = DB::table('fichars')
        ->join('users', 'user_id', '=', 'users.id')
        ->select('nombre', 'fechaInicio', 'fechaFin', 'fichars.id as fichaId', DB::raw('fechaInicio - fechaFin as horas'))
        ->orderBy('fechaFin', 'asc')
        ->paginate(10);


        return view('livewire.show-fichas', compact("fichas"));
    }

    
}
