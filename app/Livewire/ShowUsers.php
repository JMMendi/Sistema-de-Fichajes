<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateUser;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowUsers extends Component
{
    public string $campo = "nombre", $orden = "desc";

    public string $buscar = "";

    public bool $abrirModalEditar = false;
    public FormUpdateUser $uform;

    #[On("onBorrado")]
    public function render()
    {
        $usuarios = User::select('nombre', 'username', 'DNI', 'horasMes', 'id')
        ->where(function($q) {
            $q -> where('nombre', 'like', "%{$this->buscar}%")
            ->orWhere('username', 'like', "%{$this->buscar}%")
            ->orWhere('DNI', 'like', "%{$this->buscar}%");
        })
        ->orderBy($this->campo, $this->orden)
        ->get();
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

    public function update() {
        $this->uform->fUpdateUser();

        $this->dispatch('mensaje', 'Empleado actualizado correctamente');

        $this->cerrarModal();
    }

    public function cerrarModal() {
        $this->uform->resetear();
        $this->abrirModalEditar = false;
    }

    public function confirmarBorrarEmpleado(int $id) {
        $empleado = User::findOrFail($id);

        $this->authorize('delete', $empleado);
        $this->dispatch('onBorrarEmpleado', $id);
    }

    #[On('onConfirmar')]
    public function borrarEmpleado(int $id) {
        $empleado = User::findOrFail($id);

        $empleado->delete();
        $this->dispatch('mensaje', 'Empleado borrado correctamente de la base de datos');
        $this->dispatch('onBorrado');
    }


}
