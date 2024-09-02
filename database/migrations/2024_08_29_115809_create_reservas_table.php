<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->char('id_reserva',36)->primary();
            $table->foreignId('id_mesa')->constrained('mesas', 'id_mesa');
            $table->foreignId('id_cliente')->constrained('users');
            $table->date('fecha_reserva');
            $table->time('hora_reserva');
            $table->integer('cantidad_personas');
            $table->enum('estado_reserva', ['Pendiente', 'Confirmada', 'Cancelada']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
