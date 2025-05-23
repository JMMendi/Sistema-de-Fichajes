<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormRegistroUsuarios extends Form
{
    #[Rule(['required', 'string', 'min:3', 'max:100', 'unique:users,username'])]
    public string $username = "";

    #[Rule(['required', 'string', 'min:3', 'max:120'])]
    public string $nombre = "";

    #[Rule(['required', 'string', 'min:3', 'max:50'])]
    public string $password = "";

    #[Rule(['required', 'integer'])]
    public int $horasMes = 0;

    #[Rule(['required', 'decimal:0,1'])]
    public float $horasDia = 0;

    #[Rule(['required', 'string', 'regex:/^[0-9]{8}[A-Z]$/'])]
    public string $DNI = "";

    public function fCrearUsuario() {
        $this->validate();

        User::create([
            'username' => strtolower($this->username),
            'nombre' => $this->nombre,
            'password' => Hash::make($this->password),
            'horasMes' => $this->horasMes,
            'horasDia' => $this->horasDia,
            'DNI' => $this->DNI,
        ]);
    }

    public function resetear() {
        $this->reset();
        $this->resetValidation();
    }
}
