<?php

namespace App\Livewire\Forms;

use App\Models\Festivo;
use Illuminate\Support\Facades\Date;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormRegistroFestividad extends Form
{
    #[Rule(['required', 'string', 'min:3', 'max:80'])]
    public string $nombre = "";

    #[Rule(['required', 'date'])]
    public string $fecha = "";

    #[Rule(['required', 'in:Fijo,Variable'])]
    public string $tipo = "";

    #[Rule(['required', 'integer', 'min:1', 'max:31'])]
    public int $dia = -1;

    #[Rule(['required', 'integer', 'min:1', 'max:12'])]
    public int $mes = -1;

    public function create() {
        $this->dia = \Carbon\Carbon::create($this->fecha)->format('d');
        $this->mes = \Carbon\Carbon::create($this->fecha)->format('m');

        $this->validate();

        Festivo::create([
            'nombre' => $this->nombre,
            'dia' => $this->dia,
            'mes' => $this->mes,
            'tipo' => $this->tipo,
        ]);
    }

    public function resetear() {
        $this->resetValidation();
        $this->reset();
    }

}
