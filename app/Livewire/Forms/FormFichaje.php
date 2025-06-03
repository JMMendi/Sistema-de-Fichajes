<?php

namespace App\Livewire\Forms;

use App\Models\Fichar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormFichaje extends Form
{
    // Primero validaciones
    public ?Fichar $ficha = null;
    public $fechaFin = null;

    public float $latitudSalida = -1;

    public float $longitudSalida = -1;

    public string $motivoEntrada = "";

    public ?string $motivoSalida = "";

    #[Rule(['required', 'exists:users,id'])]    
    public int $user_id = -1;

    #[Rule(['required', 'date'])]
    public $fechaInicio = -1;

    #[Rule(['required', "in:Manual,Diario"])]
    public string $tipo = "";

    #[Rule(['required', 'numeric'])]
    public float $latitudEntrada = -1;

    #[Rule(['required', 'numeric'])]
    public float $longitudEntrada = -1;



    public function formStoreFichaje()
    {
        $this->tipo = "Manual";

        if (!in_array($this->motivoSalida, $this->listaMotivos()) || !$this->fechaFin) {
            $this->motivoSalida = null;
        }

        if ($this->fechaFin == -1) {
            $this->fechaFin = null;
        }

        $this->validate();

        if ($this->fechaFin != null) {
            Fichar::create([
                'fechaInicio' => Carbon::parse($this->fechaInicio),
                'fechaFin' => Carbon::parse($this->fechaFin),
                'tipo' => $this->tipo,
                'user_id' => $this->user_id,
                'latidudEntrada' => 36.8497134,
                'longitudEntrada' => -2.4486812,
                'motivoEntrada' => $this->motivoEntrada,
                'motivoSalida' => $this->motivoSalida,

            ]);
        } else {
            Fichar::create([
                'fechaInicio' => Carbon::parse($this->fechaInicio),
                'tipo' => $this->tipo,
                'user_id' => $this->user_id,
                'latidudEntrada' => 36.8497134,
                'longitudEntrada' => -2.4486812,
                'latidudSalida' => 36.8497134,
                'longitudSalida' => -2.4486812,
                'motivoEntrada' => $this->motivoEntrada,
            ]);
        }
    }

    public function listaMotivos(): array
    {
        $prueba = new Fichar();
        return $prueba->arrayMotivos();
    }

    public function resetear()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function formStoreEntrada($latitud, $longitud)
    {
        $this->latitudEntrada = $latitud;
        $this->longitudEntrada = $longitud;

        $fecha = Carbon::now();

        Fichar::create([
            'fechaInicio' => $fecha,
            'user_id' => Auth::id(),
            'tipo' => 'Diario',
            'latitudEntrada' => $this->latitudEntrada,
            'longitudEntrada' => $this->longitudEntrada,
            'motivoEntrada' => $this->motivoEntrada,
        ]);
    }

    public function formStoreSalida($latitud, $longitud)
    {
        $this->latitudSalida = $latitud;
        $this->longitudSalida = $longitud;
        $fichaje = Fichar::where('user_id', '=', Auth::id())
            ->where('fechaFin', null)
            ->get();

        $this->ficha = Fichar::findOrFail($fichaje[0]->id);
        $this->ficha->update([
            'fechaFin' => Carbon::now(),
            'latidudSalida' => $this->latitudSalida,
            'longitudSalida' => $this->longitudSalida,
            'motivoSalida' => $this->motivoSalida,
        ]);
    }

    public function rules(): array
    {
        $regla = "";
        if ($this->fechaFin) {
            $regla = "required";
        } else {
            $regla = "nullable";
        }
        return [
            'fechaFin' => ['nullable', 'date', 'after_or_equal:' . $this->fechaInicio],
            'motivoEntrada' => ['required', "in:".implode(',', $this->listaMotivos())],
            'motivoSalida' => ['nullable', "in:".implode(',', $this->listaMotivos())],
            'latitudSalida' => [$regla, 'numeric'],
            'longitudSalida' => [$regla, 'numeric'],

        ];
    }
}
