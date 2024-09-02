<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';
    protected $hidden = ['created_at', 'updated_at'];
    protected $keyType = 'string'; // type of primary key
    protected $fillable = [
        'id_reserva',
        'id_mesa',
        'id_cliente',
        'fecha_reserva',
        'hora_reserva',
        'cantidad_personas',
        'estado_reserva'
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa', 'id_mesa');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente', 'id');
    }
}
