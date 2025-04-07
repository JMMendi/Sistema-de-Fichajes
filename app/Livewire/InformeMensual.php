<?php

namespace App\Livewire;

use App\Models\Fichar;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InformeMensual extends Component
{

    public int $user_id = -1;

    public $fechaInicio;

    public $fechaFin;

    public bool $show = false;

    public $fichas;

    public $empleado = null;

    public function render()
    {
        $usuarios = User::select('id', 'nombre')->get();
        return view('livewire.informe-mensual', compact('usuarios'));
    }

    public function recogerDatos()
    {
        $fichas = Fichar::select('user_id', 'fechaInicio', 'fechaFin', 'tipo', DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas'))
            ->where('user_id', '=', $this->user_id)
            ->where('fechaInicio', '>', $this->fechaInicio)
            ->where('fechaFin', '<', $this->fechaFin)
            ->orderBy('fechaInicio', 'desc')
            ->get();

        $this->fichas = $fichas;

        $this->empleado = User::findOrFail($this->user_id);

        $this->show = true;
    }

    public function generarPdf() 
    {
        $data = [
            'empleado' => $this->empleado,
            'fichas' => Fichar::select('user_id', 'fechaInicio', 'fechaFin', 'tipo', DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas'))
                ->where('user_id', '=', $this->user_id)
                ->where('fechaInicio', '>', $this->fechaInicio)
                ->where('fechaFin', '<', $this->fechaFin)
                ->orderBy('fechaInicio', 'desc')
                ->get(),
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
        ];

        $pdf = Pdf::loadView('livewire.informe', $data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
            }, $this->empleado->nombre . " - " . \Carbon\Carbon::parse($this->fechaInicio)->format('d-m-Y')."_".\Carbon\Carbon::parse($this->fechaFin)->format('d-m-Y').".pdf");
    }
}
