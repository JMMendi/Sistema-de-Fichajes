<?php

namespace App\Livewire;

use App\Models\Fichar;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Acumulado extends Component
{
    public int $user_id = -1;

    public $fechaInicio = null;

    public $fechaFin = null;

    public bool $show = false;

    public $fichas;

    public $fechas = [];

    public $empleado = null;

    public function render()
    {
        $usuarios = User::select('id', 'nombre')->get();
        return view('livewire.acumulado', compact('usuarios'));
    }

    public function recogerDatos()
    {
        if ($this->user_id == -1 || $this->fechaInicio == null || $this->fechaFin == null) {
            $this->js("alert('Error, rellene los campos corretamente')");
        } else {
            $this->resetear();

            $sub = Fichar::select(
                'user_id',
                DB::raw('DATE_FORMAT(fechaInicio, "%Y-%m") as fecha'),
                DB::raw("round(timestampdiff(MINUTE, fechaInicio, fechaFin) / 60) as horas")
            )
                ->where('user_id', '=', $this->user_id);

            $fichas = DB::table($sub)
                ->select(
                    'user_id',
                    'fecha',
                    DB::raw("SUM(horas) as acumulado"),
                    'horasMes',
                    DB::raw("(horasMes - SUM(horas)) as diferencia")
                )
                ->join('users', 'user_id', '=', 'id')
                ->groupBy('user_id', "fecha")
                ->get();
            $this->fichas = $fichas;
            $this->empleado = User::findOrFail($this->user_id);

            $this->show = true;
        }
    }

    public function resetear()
    {
        $this->fichas = null;
        $this->empleado = null;
        $this->show = false;
    }

    public function generarPdf()
    {
        $sub = Fichar::select(
            'user_id',
            DB::raw('DATE_FORMAT(fechaInicio, "%Y-%m") as fecha'),
            DB::raw("round(timestampdiff(MINUTE, fechaInicio, fechaFin) / 60) as horas")
        )
            ->where('user_id', '=', $this->user_id);

        $data = [
            'empleado' => $this->empleado,
            'fichas' =>  DB::table($sub)
                ->select(
                    'user_id',
                    'fecha',
                    DB::raw("SUM(horas) as acumulado"),
                    'horasMes',
                    DB::raw("(horasMes - SUM(horas)) as diferencia")
                )
                ->join('users', 'user_id', '=', 'id')
                ->groupBy('user_id', "fecha")
                ->get(),
        ];

        $pdf = Pdf::loadView('livewire.informe-acumulado', $data);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "Informe acumulado de " . $this->empleado->nombre . " - " . \Carbon\Carbon::parse($this->fechaInicio)->format('d-m-Y') .
            "-" . \Carbon\Carbon::parse($this->fechaFin)->format('d-m-Y') . ".pdf");
    }
}
