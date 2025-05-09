<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormUpdateUser extends Form
{
    public ?User $empleado = null;

    public string $username = "";

    #[Rule(['required', 'string', 'min:3', 'max:120'])]
    public string $nombre = "";

    #[Rule(['nullable', 'string', 'min:3', 'max:50'])]
    public string $password = "";

    #[Rule(['required', 'integer'])]
    public int $horasMes = 0;

    #[Rule(['required', 'decimal:0,1'])]
    public int $horasDia = 0;

    #[Rule(['required', 'string', 'regex:/^[0-9]{8}[A-Z]$/'])]
    public string $DNI = "";

    public function setUser(User $empleado) {
        $this->empleado = $empleado;

        $this->username = $empleado->username;
        $this->nombre = $empleado->nombre;
        $this->horasMes = $empleado->horasMes;
        $this->horasDia = $empleado->horasDia;
        $this->DNI = $empleado->DNI;

    }

    public function fUpdateUser() {
        $this->validate();

        if ($this->password != "") {
            $this->empleado->update([
                'username' => $this->username,
                'nombre' => $this->nombre,
                'password' => $this->password,
                'horasMes' => $this->horasMes,
                'horasDia' => $this->horasDia,
                'DNI' => $this->DNI,
            ]);
        } else {
            $this->empleado->update([
                'username' => $this->username,
                'nombre' => $this->nombre,
                'horasMes' => $this->horasMes,
                'horasDia' => $this->horasDia,
                'DNI' => $this->DNI,
            ]);
        }
    }

    public function resetear() {
        $this->reset();
        $this->resetValidation();
    }

    
    public function rules() : array {
        return [
            'username' => ['required', 'string', 'min:3', 'max:100', 'unique:users,username,'.$this->empleado->id],
        ];
    }
}
