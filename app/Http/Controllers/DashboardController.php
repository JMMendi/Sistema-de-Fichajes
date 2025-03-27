<?php

namespace App\Http\Controllers;

use App\Models\Fichar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class DashboardController extends Controller
{
    #[On('salida', 'entrada')]
    public function index() {
        $fichaje = Fichar::where('user_id', '=', Auth::id())->where('fechaFin', null)->get();
        // dd($fichaje);
        return view('dashboard', compact('fichaje'));
    }

}
