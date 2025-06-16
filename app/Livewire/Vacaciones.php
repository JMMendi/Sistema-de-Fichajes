<?php

namespace App\Livewire;

use App\Livewire\Forms\FormRegistroVacacion;
use App\Models\Vacacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Vacaciones extends Component
{
    public bool $show = false;
    public FormRegistroVacacion $cform;
    public bool $showConfirmar = false;

    #[On(['entrada', 'salida'])]
    public function render()
    {
        $fechas = Vacacion::select('inicioVac', 'finVac', 'confirmado')
            ->where('user_id', '=', Auth::id());

        $vacaciones = DB::table('vacacions')
            ->join('users', 'user_id', '=', 'users.id')
            ->select('vacacions.id', 'nombre', 'inicioVac', 'finVac', 'confirmado')
            ->get();

        return view('livewire.vacaciones', compact('fechas', 'vacaciones'));
    }

    public function creaRegistro()
    {
        $this->cform->store();

        $this->dispatch('mensaje', 'Se ha registrado las fechas de las vacaciones');

        $this->dispatch('entrada')->to(Vacaciones::class);

        $this->cerrarModal();
    }

    public function resetear()
    { {
            $this->reset();
            $this->resetValidation();
        }
    }

    public function abrirModal()
    {
        $this->show = true;
    }

    public function cerrarModal()
    {
        $this->resetear();
        $this->show = false;

    }

    // Para la modal de Confirmar o Denegar vacaciones

    public function abrirModalConfirmar()
    {
        $this->showConfirmar = true;
    }

    public function actualizarVacaciones(int $id) {
        $vacacion = Vacacion::findOrfail($id);

        $confirmado = "";

        switch($vacacion->confirmado) {
            case "Si":
                $confirmado = "No";
                break;
            case "No":
                $confirmado = "Pendiente";
                break;
            case "Pendiente":
                $confirmado = "Si";
                break;
        }

        $vacacion->update([
            'confirmado' => $confirmado,
        ]);
    }

    // Para borrar un registro de vacaciones
    
    public function confirmarBorrado(int $id) {
        Vacacion::findOrFail($id);

        $this->dispatch('onBorrarVacacion', $id);

    }

    #[On('onConfirmar')]
    public function borrarVacacion(int $id) {
        $vacacion = Vacacion::findOrFail($id);

        $vacacion->delete();

        $this->dispatch('mensaje', 'Registro de vacaciones eliminado correctamente');
    }
}
