<?php

namespace App\Livewire\Forms;

use App\Models\Fichar;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateFichaje extends Form
{
    public ?Fichar $ficha = null;
    public $fechaFin = null;

    // #[Rule(['required', 'exists:users,id'])]
    // public int $user_id = -1;

    #[Rule(['required', 'date', 'before_or_equal:today'])]
    public $fechaInicio = -1;

    #[Rule(['required', "in:Manual,Diario"])]
    public string $tipo = "";

    public function setFichaje(Fichar $ficha) {
        $this->ficha = $ficha;
        // $this->user_id = $ficha->user_id;
        $this->fechaInicio = $ficha->fechaInicio;
        $this->fechaFin = $ficha->fechaFin;
    }

    public function fUpdateFichaje() {
        $this->validate();

        $this->ficha->update([
            'fechaInicio' => Carbon::parse($this->fechaInicio),
            'fechaFin' => Carbon::parse($this->fechaFin),
            'tipo' => "Manual",
        ]);
    }

    public function resetear() {
        $this->reset();
        $this->resetValidation();
        
    }

    public function rules(): array
    {
        return [
            'fechaFin' => ['nullable', 'date', 'after_or_equal:'.$this->fechaInicio],
        ];
    }
}
