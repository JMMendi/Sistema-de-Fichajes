<?php

namespace App\Livewire\Forms;

use App\Models\Vacacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormRegistroVacacion extends Form
{
    public $finVac = "";

    #[Rule(['required', 'exists:users,id'])]
    public int $user_id = -1;

    #[Rule(['required', 'date'])]
    public $inicioVac = "";

    #[Rule(['required', 'in:Si,No,Pendiente'])]
    public string $confirmado = "Pendiente";

    public function store() {
        $this->user_id = Auth::id();

        $this->validate();

        Vacacion::create([
            'user_id' => Auth::id(),
            'inicioVac' => \Carbon\Carbon::parse($this->inicioVac),
            'finVac' => \Carbon\Carbon::parse($this->finVac),
            'confirmado' => "Pendiente",
        ]);

       
    }

    public function rules() {
        return [
            'finVac' => ['required', 'date', 'afterOrEqual:'.$this->inicioVac],
        ];  
    }
}
