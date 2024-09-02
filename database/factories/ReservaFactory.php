<?php

namespace Database\Factories;

use App\Models\Mesa;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mesas = Mesa::all();
        $clientes = User::all();

        $id_mesa_selected = $this->faker->randomElement($mesas)->id_mesa;
        $capacidad_mesa = Mesa::find($id_mesa_selected)->capacidad;

        return [
            'id_reserva' => $this->faker->uuid(),
            'id_mesa' => $id_mesa_selected,
            'id_cliente' => $this->faker->randomElement($clientes)->id,
            'fecha_reserva' => $this->faker->date(),
            'hora_reserva' => $this->faker->time(),
            'cantidad_personas' => $this->faker->numberBetween(1, $capacidad_mesa),
            'estado_reserva' => $this->faker->randomElement(['Pendiente', 'Confirmada', 'Cancelada']),
        ];
    }
}
