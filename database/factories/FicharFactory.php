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
            'fechaInicio' => fake()->dateTimeBetween('+1 week', '+3 week'),
            'fechaFin' => fake()->dateTimeBetween('+1 week', '+3 week'),
            'user_id' => User::all()->random()->id,
            'tipo' => fake()->randomElement(['Manual', 'Diario'])
        ];
    }
}
