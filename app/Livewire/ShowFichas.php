<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateFichaje;
use App\Models\Fichar;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowFichas extends Component
{
    public bool $abrirModalEditar = false;
    public FormUpdateFichaje $uform;

    public function render()
    {
        $fichas = DB::table('fichars')
        ->join('users', 'user_id', '=', 'users.id')
        ->select('nombre', 'fechaInicio', 'fechaFin', 'fichars.id as fichaId', 'fichars.created_at', DB::raw('fechaInicio - fechaFin as horas'))
        // modificar la consulta del atributo calculado
        ->orderBy('fichars.created_at', 'desc')
        ->paginate(10);


        return view('livewire.show-fichas', compact("fichas"));
    }

    // Para el Update/Edit

    public function edit(int $id) {
        $ficha = Fichar::findOrFail($id);

        $this->uform->setFichaje($ficha);
        $this->abrirModalEditar = true;
    }

    public function cerrarModal() {
        $this->uform->resetear();
        $this->abrirModalEditar = false;
    }

    public function update() {
        $this->uform->fUpdateFichaje();

        $this->cerrarModal();

        $this->dispatch('mensaje', 'Fichaje editado correctamente');
    }
}
