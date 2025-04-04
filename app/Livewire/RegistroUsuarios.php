<?php

namespace App\Livewire;

use App\Livewire\Forms\FormRegistroUsuarios;
use Livewire\Component;

class RegistroUsuarios extends Component
{
    public FormRegistroUsuarios $cform;

    public bool $abrirModalCrear = false;

    public function render()
    {
        return view('livewire.registro-usuarios');
    }

    public function store() {
        $this->cform->fCrearUsuario();

        $this->dispatch('mensaje', 'Usuario creado correctamente');

        $this->cerrarModalCrear();
    }

    public function cerrarModalCrear() {
        $this->cform->resetear();
        $this->abrirModalCrear = false;
    }

}
