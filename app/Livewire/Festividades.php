<?php

namespace App\Livewire;

use App\Livewire\Forms\FormRegistroFestividad;
use App\Models\Festivo;
use Livewire\Component;

class Festividades extends Component
{
    public bool $abrirModalFestividades = false;

    public bool $modalAdd = false;

    public FormRegistroFestividad $cform;

    public function render()
    {
        $dias = Festivo::select('nombre', 'dia', 'mes')->get();
        return view('livewire.festividades', compact('dias'));
    }

    public function store() {
        $this->cform->create();

        $this->dispatch('mensaje', 'Festividad añadida con éxito');
        $this->cform->resetear();
    }

    public function cerrarModal() {
        $this->cform->resetear();
        $this->abrirModalFestividades = false;
    }

    public function cerrarFormulario() {
        $this->cform->resetear();
        $this->modalAdd = false;
    }



}
