<?php

namespace App\Livewire;

use App\Livewire\Forms\FormRegistroUsuarios;
use Livewire\Component;

class RegistroUsuarios extends Component
{
    public FormRegistroUsuarios $cform;

    public function render()
    {
        return view('livewire.registro-usuarios');
    }

    public function store() {
        $this->cform->fCrearUsuario();

        $this->dispatch('mensaje', 'Usuario creado correctamente');

        $this->cform->resetear();
    }

}
