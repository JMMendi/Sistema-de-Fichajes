<?php

namespace App\Livewire\Forms;

use App\Models\Fichar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormFichaje extends Form
{
    // Primero validaciones
    public Fichar $ficha;
    public $fechaFin = null;

    #[Rule(['required', 'exists:users,id'])]
    public int $user_id = -1;

    #[Rule(['required', 'date', 'before_or_equal:today'])]
    public $fechaInicio = -1;

    #[Rule(['required', "in:Manual,Diario"])]
    public string $tipo = "";

    public function formStoreFichaje()
    {
        if (Auth::user()->admin) {
            $this->tipo = "Manual";
        } else {
            $this->user_id = Auth::user()->id;
            $this->tipo = "Diario";
        }

        $this->validate();

        Fichar::create([
            'fechaInicio' => Carbon::parse($this->fechaInicio),
            'fechaFin' =>Carbon::parse($this->fechaFin),
            'tipo' => $this->tipo,
            'user_id' => $this->user_id,
        ]);
        
    }

    public function resetear()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function formStoreEntrada()
    {
        $fecha = Carbon::now();
        Fichar::create([
            'fechaInicio' => $fecha,
            'user_id' => Auth::id(),
            'tipo' => 'Diario',
        ]);
    }

    public function formStoreSalida()
    {
        $fichaje = Fichar::where('user_id', '=', Auth::id())->where('fechaFin', null)->get();
        $this->ficha = Fichar::findOrFail($fichaje[0]->id);
        $this->ficha->update([
            'fechaFin' => Carbon::now(),
        ]);


    }

    public function rules(): array
    {
        return [
            'fechaFin' => ['nullable', 'date', 'after_or_equal:'.$this->fechaInicio],
        ];
    }
}
