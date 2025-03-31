<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateFichaje;
use App\Models\Fichar;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowFichas extends Component
{
    use WithPagination;

    public string $campo="fichars.created_at", $orden="asc";
    public string $texto="";

    public bool $abrirModalEditar = false;
    public FormUpdateFichaje $uform;

    public function render()
    {
        $fichas = DB::table('fichars')
        ->join('users', 'user_id', '=', 'users.id')
        ->select('nombre', 'fechaInicio', 'fechaFin', 'tipo', 'fichars.id as fichaId', 'fichars.created_at', DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas'))
        ->where(function($q) {
            $q->where('nombre', 'like', "%{$this->texto}%")
            ->orWhere('fechaInicio', 'like', "%{$this->texto}%")
            ->orWhere('tipo', 'like', "%{$this->texto}%");
        })
        ->orderBy($this->campo, $this->orden)
        ->paginate(10);


        return view('livewire.show-fichas', compact("fichas"));
    }

    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }

    // Para que funcione en cualquier página de la paginación
    public function updatingTexto(){
        $this->resetPage();
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
