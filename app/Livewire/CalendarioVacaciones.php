<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Vacacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CalendarioVacaciones extends Component
{
    public $vacaciones = null;

    public function render()
    {
        if (Auth::user()->admin) {
            $vacaciones = DB::table('vacacions')
                ->join('users', 'user_id', '=', 'users.id')
                ->select('vacacions.id', 'nombre', 'inicioVac', 'finVac', 'confirmado')
                ->get();
            $vacaciones->toArray();

            $this->vacaciones = $vacaciones;
        } else {
            $vacacionesUsuario = Vacacion::select('id', 'inicioVac', 'finVac', 'confirmado')
            ->where('user_id', '=', Auth::id())
            ->get();
            $vacacionesUsuario->toArray();

            $this->vacaciones = $vacacionesUsuario;
        }

        if (Auth::user()->admin) {
            $eventos = $this->crearVacaciones();
        } else {
            $eventos = $this->crearVacacionesUsuario();
        }

        return view('livewire.calendario-vacaciones', compact('eventos'));
    }

    public function crearVacaciones()
    {
        $eventos = array();

        foreach ($this->vacaciones as $item) {
            $titulo = "";
            $color = "";

            if ($item->confirmado == "Pendiente") {
                $titulo = $item->nombre . " - Vacaciones Pendientes";
                $color = "gray";
            } elseif ($item->confirmado == "No") {
                $titulo = $item->nombre . " - Vacaciones Denegadas";
                $color = "red";
            } elseif ($item->confirmado == "Si") {
                $titulo = $item->nombre . " - Vacaciones Aceptadas";
                $color = "blue";
            }

            $eventos[] = [
                'title' => $titulo,
                'start' => \Carbon\Carbon::parse($item->inicioVac)->format('Y-m-d'),
                'end' => \Carbon\Carbon::parse($item->finVac)->format('Y-m-d'),
                'backgroundColor' => $color
            ];
        }
        return $eventos;
    }

    public function crearVacacionesUsuario()
    {
        $eventos = array();

        foreach ($this->vacaciones as $item) {
            $titulo = "";
            $color = "";

            if ($item->confirmado == "Pendiente") {
                $titulo = "Vacaciones Pendientes";
                $color = "gray";
            } elseif ($item->confirmado == "No") {
                $titulo = "Vacaciones Denegadas";
                $color = "red";
            } elseif ($item->confirmado == "Si") {
                $titulo = "Vacaciones Aceptadas";
                $color = "orange";
            }

            $eventos[] = [
                'title' => $titulo,
                'start' => \Carbon\Carbon::parse($item->inicioVac)->format('Y-m-d'),
                'end' => \Carbon\Carbon::parse($item->finVac)->format('Y-m-d'),
                'backgroundColor' => $color
            ];
        }
        return $eventos;
    }
}
