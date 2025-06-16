<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormRegistroUsuarios extends Form
{
    public string $normal = "";

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

    #[Rule('boolean')]
    public ?bool $superior = null;

    #[Rule('boolean')]
    public ?bool $admin = null;

    public function fCrearUsuario() {
        $this->privilegios();

        $this->validate();

        User::create([
            'username' => strtolower($this->username),
            'nombre' => $this->nombre,
            'password' => Hash::make($this->password),
            'horasMes' => $this->horasMes,
            'horasDia' => $this->horasDia,
            'DNI' => $this->DNI,
            'superior' => $this->superior,
            'admin' => $this->admin,
        ]);
    }

    public function privilegios() {
        if($this->normal) {
            $this->superior = false;
            $this->admin = false;
        }

        if($this->admin) {
            $this->superior = false;
        }
        
        if($this->superior) {
            $this->admin = false;
        }
    }

    public function resetear() {
        $this->reset();
        $this->resetValidation();
    }
}
