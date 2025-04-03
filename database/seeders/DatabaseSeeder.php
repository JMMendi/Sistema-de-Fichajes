<?php

namespace Database\Seeders;

use App\Models\Fichar;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'username' => 'admin',
            'nombre' => 'Administrador',
            'password' => 'secret0',
            'horasMes' => 120,
            'admin' => true,
        ]);

        Fichar::factory(50)->create();
    }
}
