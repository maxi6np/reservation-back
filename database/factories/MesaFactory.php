<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mesa>
 */
class MesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'capacidad' => $this->faker->numberBetween(1, 10),
            'estado_mesa' => $this->faker->randomElement(['Disponible', 'Ocupada', 'Reservada']),
        ];
    }
}
