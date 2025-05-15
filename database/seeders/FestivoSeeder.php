<?php

namespace Database\Seeders;

use App\Models\Festivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FestivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            'Año nuevo',
            'Epifanía del Señor',
            'San José',
            'Fiesta del Trabajo',
            'Santiago Apóstol',
            'Asunción de la Virgen',
            'Fiesta Nacional de España',
            'Todos los Santos',
            'Constitución Española',
            'Inmaculada Concepción',
            'Natividad del Señor'
        ];

        $dias = [
            1, 6, 19, 1, 25, 15, 12, 1, 6, 8, 25
        ];

        $meses = [
            1, 1, 3, 5, 7, 8, 10, 11, 12, 12, 12
        ];

        for($i = 0; $i < count($nombres) ; $i++) {
            Festivo::create([
                'nombre' => $nombres[$i],
                'dia' => $dias[$i],
                'mes' => $meses[$i],
                'tipo' => "Fijo",
            ]);
        }
    }
}
