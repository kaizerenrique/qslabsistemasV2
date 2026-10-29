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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                  ->unique()
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->foreignId('sucursal_id')
                  ->nullable()
                  ->constrained('laboratorio_sucursales')
                  ->nullOnDelete();

            // tipo: domicilio | sucursal
            $table->string('tipo', 20);

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->foreignId('flebotomista_id')
                  ->nullable()
                  ->constrained('flebotomistas')
                  ->nullOnDelete();

            $table->foreignId('direccion_id')
                  ->nullable()
                  ->constrained('direcciones_pacientes')
                  ->nullOnDelete();

            // estado: programada | confirmada | en_camino |
            //         completada | cancelada | no_asistio
            $table->string('estado', 25)->default('programada')->index();

            $table->text('notas')->nullable();

            $table->timestamps();

            $table->index(['laboratorio_id', 'fecha', 'estado']);
            $table->index(['flebotomista_id', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
