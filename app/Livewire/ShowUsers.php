<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateUser;
use App\Models\User;
use Livewire\Component;

class ShowUsers extends Component
{
    public string $campo = "nombre", $orden = "desc";

    public string $buscar = "";

    public bool $abrirModalEditar = false;
    public FormUpdateUser $uform;

    public function render()
    {
        $usuarios = User::select('nombre', 'username', 'DNI', 'horasMes', 'id')->orderBy($this->campo, $this->orden)->get();
        return view('livewire.show-users', compact('usuarios'));
    }

    public function ordenar(string $campo) {
        $this->orden = ($this->orden == "asc") ? "desc" : "asc";
        $this->campo = $campo;
    }

    public function edit(int $id) {
        $empleado = User::findOrFail($id);

        $this->uform->setUser($empleado);

        $this->abrirModalEditar = true;
    }

    public function cerrarModal() {
        $this->uform->resetear();
        $this->abrirModalEditar = false;
    }
}
