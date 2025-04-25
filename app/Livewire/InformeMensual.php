<?php

namespace App\Livewire;

use App\Models\Fichar;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InformeMensual extends Component
{
    public int $user_id = -1;

    public ?DateTime $fechaInicio = null;

    public ?DateTime $fechaFin = null;

    public bool $show = false;

    public $fichas;

    public $fichaHoras;

    public $empleado = null;

    public function render()
    {
        $usuarios = User::select('id', 'nombre')->get();
        return view('livewire.informe-mensual', compact('usuarios'));
    }

    public function recogerDatos()
    {
        if ($this->user_id == 1 || $this->fechaInicio == null || $this->fechaFin == null) {
            $this->js("alert('Error, rellene los campos corretamente')");
        } else {
            $fichas = Fichar::select(
                'user_id',
                'fechaInicio',
                'fechaFin',
                'tipo',
                DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas')
            )
                ->where('user_id', '=', $this->user_id)
                ->where('fechaInicio', '>', $this->fechaInicio)
                ->where('fechaFin', '<', $this->fechaFin)
                ->orderBy('fechaInicio', 'desc')
                ->get();
            $this->fichaHoras = Fichar::select(DB::raw('sum(hour(timediff(fechaInicio, fechaFin))) as horasTotales'))
                ->where('user_id', '=', $this->user_id)
                ->where('fechaInicio', '>', $this->fechaInicio)
                ->where('fechaFin', '<', $this->fechaFin)
                ->orderBy('fechaInicio', 'desc')
                ->get();

            $this->fichas = $fichas;

            $this->empleado = User::findOrFail($this->user_id);

            $this->show = true;
        }
    }

    public function generarPdf()
    {
        $data = [
            'empleado' => $this->empleado,
            'fichas' => Fichar::select(
                'user_id',
                'fechaInicio',
                'fechaFin',
                'tipo',
                DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas')
            )
                ->where('user_id', '=', $this->user_id)
                ->where('fechaInicio', '>', $this->fechaInicio)
                ->where('fechaFin', '<', $this->fechaFin)
                ->orderBy('fechaInicio', 'desc')
                ->get(),
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
            'fichaHoras' => Fichar::select(DB::raw('sum(hour(timediff(fechaInicio, fechaFin))) as horasTotales'))
                ->where('user_id', '=', $this->user_id)
                ->where('fechaInicio', '>', $this->fechaInicio)
                ->where('fechaFin', '<', $this->fechaFin)
                ->orderBy('fechaInicio', 'desc')
                ->get(),

        ];

        $pdf = Pdf::loadView('livewire.informe', $data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $this->empleado->nombre . " - " . \Carbon\Carbon::parse($this->fechaInicio)->format('d-m-Y') .
            "_" . \Carbon\Carbon::parse($this->fechaFin)->format('d-m-Y') . ".pdf");
    }
}
