<?php

namespace App\Livewire;

use App\Models\Fichar;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InformeMensual extends Component
{
    public int $user_id = -1;

    public $fechaInicio = null;

    public $fechaFin = null;

    public ?DateTime $fechaPrincipio = null;

    public ?DateTime $fechaFinal = null;

    public bool $show = false;

    public $fichas;

    public $fichaHoras;

    public $fechas = [];

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

            $this->rangoFechas();

            $this->show = true;
        }
    }

    public function rangoFechas() : array {
        $fechaPrincipio = new Carbon($this->fechaInicio);
        $fechaFinal = new Carbon($this->fechaFin);

        $intervalo = CarbonInterval::createFromDateString('1 day');
        $periodo = CarbonPeriod::create($fechaPrincipio, $intervalo, $fechaFinal);

        foreach($periodo as $item) {
            $this->fechas[] = $item->format('d-m-Y');
        }
        
        // dd($fechas);

        return $this->fechas;
    }

    public function generarPdf()
    {
        $this->fechaPrincipio = Carbon::parse($this->fechaInicio);
        $this->fechaFinal = Carbon::parse($this->fechaFin);

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
            'fechaInicio' => $this->fechaPrincipio->format('d-m-Y'),
            'fechaFin' => $this->fechaFinal->format('d-m-Y'),
            'fechas' => $this->fechas,
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
