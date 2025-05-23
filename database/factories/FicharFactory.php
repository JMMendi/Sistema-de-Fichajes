<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fichar>
 */
class FicharFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fechaInicio' => fake()->dateTimeInInterval('-1 week', '+1 day'),
            'fechaFin' => fake()->dateTimeInInterval('-1 week', '+1 day'),
            'user_id' => User::all()->random()->id,
            'latitudEntrada' => fake()->randomFloat(),
            'longitudEntrada' => fake()->randomFloat(),
            'latitudSalida' => fake()->randomFloat(),
            'longitudSalida' => fake()->randomFloat(),
            'motivoEntrada' => fake()->randomElement(['Rutina', 'Atraso', 'Otro']),
            'motivoSalida' => fake()->randomElement(['Rutina', 'Médico', 'Almuerzo', 'Descanso', 'Otro']),
            'tipo' => fake()->randomElement(['Manual', 'Diario']),
        ];
    }
}
