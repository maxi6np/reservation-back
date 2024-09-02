<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_reserva' => $this->id_reserva,
            'cliente' => new UserResource($this->whenLoaded('cliente')),
            'mesa' => new MesaResource($this->whenLoaded('mesa')),
            'fecha_reserva' => $this->fecha_reserva,
            'hora_reserva' => $this->hora_reserva,
            'cantidad_personas' => $this->cantidad_personas,
            'estado_reserva' => $this->estado_reserva
        ];
    }
}
