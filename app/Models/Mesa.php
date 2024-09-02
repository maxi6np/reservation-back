<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected  $table = 'mesas';
    protected $primaryKey = 'id_mesa';

    protected $fillable = [
        'id_mesa',
        'capacidad',
        'estado_mesa'
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_mesa', 'id_mesa');
    }
}
