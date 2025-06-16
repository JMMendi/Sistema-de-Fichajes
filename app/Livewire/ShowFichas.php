<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateFichaje;
use App\Models\Fichar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class ShowFichas extends Component
{
    use WithPagination;

    public string $campo = "fichars.created_at", $orden = "desc";
    public string $texto = "";

    public bool $abrirModalEditar = false;
    public FormUpdateFichaje $uform;

    #[On(['onUpdate', 'onCreate'])]
    public function render()
    {
        $fichas = DB::table('fichars')
            ->join('users', 'user_id', '=', 'users.id')
            ->select(
                'nombre',
                'fechaInicio',
                'fechaFin',
                'tipo',
                'fichars.id as fichaId',
                'latitudEntrada',
                'longitudEntrada',
                'latitudSalida',
                'longitudSalida',
                "motivoEntrada",
                "motivoSalida",
                'fichars.created_at',
                'user_id',
                DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas')
            )
            ->where(function ($q) {
                $q->where('nombre', 'like', "%{$this->texto}%")
                    ->orWhere('fechaInicio', 'like', "%{$this->texto}%")
                    ->orWhere('motivoEntrada', 'like', "%{$this->texto}%")
                    ->orWhere('motivoSalida', 'like', "%{$this->texto}%")
                    ->orWhere('tipo', 'like', "%{$this->texto}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(10);

        $fichasUsuario = DB::table('fichars')
            ->join('users', 'user_id', '=', 'users.id')
            ->select(
                'nombre',
                'fechaInicio',
                'fechaFin',
                'tipo',
                'fichars.id as fichaId',
                'latitudEntrada',
                'longitudEntrada',
                'latitudSalida',
                'longitudSalida',
                "motivoEntrada",
                "motivoSalida",
                'fichars.created_at',
                'user_id',
                DB::raw('hour(timediff(fechaInicio, fechaFin)) as horas')
            )
            ->where('user_id', '=', Auth::user()->id)
            ->where(function ($q) {
                $q->where('nombre', 'like', "%{$this->texto}%")
                    ->orWhere('fechaInicio', 'like', "%{$this->texto}%")
                    ->orWhere('motivoEntrada', 'like', "%{$this->texto}%")
                    ->orWhere('motivoSalida', 'like', "%{$this->texto}%")
                    ->orWhere('tipo', 'like', "%{$this->texto}%");
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(10);
        
        $prueba = new Fichar();
        $motivos = $prueba->arrayMotivos();


        return view('livewire.show-fichas', compact("fichas", "motivos", "fichasUsuario"));
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    // Para que funcione en cualquier página de la paginación
    public function updatingTexto()
    {
        $this->resetPage();
    }

    // Para el Update/Edit

    public function edit(int $id)
    {
        $ficha = Fichar::findOrFail($id);

        $this->uform->setFichaje($ficha);
        $this->abrirModalEditar = true;
    }

    public function cerrarModal()
    {
        $this->uform->resetear();
        $this->abrirModalEditar = false;
    }

    public function update()
    {
        $this->uform->fUpdateFichaje();

        $this->cerrarModal();

        $this->dispatch('mensaje', 'Fichaje editado correctamente');
        $this->dispatch('onUpdate');
    }

    // Para borrar un fichaje

    public function confirmarBorrarFichaje(int $id)
    {
        $fichaje = Fichar::findOrFail($id);

        $this->authorize('delete', $fichaje);
        $this->dispatch('onBorrarFichaje', $id);
    }

    #[On('onConfirmar')]
    public function borrarEmpleado(int $id)
    {
        $fichaje = Fichar::findOrFail($id);

        $fichaje->delete();
        $this->dispatch('mensaje', 'Fichaje borrado correctamente de la base de datos');
        $this->dispatch('onBorrado');
    }
}
