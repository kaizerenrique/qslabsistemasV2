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
        Schema::create('resultados', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            $table->foreignId('muestra_id')
                  ->nullable()
                  ->constrained('muestras')
                  ->nullOnDelete();

            $table->foreignId('persona_atendida_id')
                  ->constrained('personas')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->string('nombre_archivo', 200);

            // código corto del QR (21 chars)
            $table->string('url_code', 21)->unique();

            // URL simbólica completa que el software del lab conoce
            $table->string('url_simbol', 500);

            // ruta en disco privado (no URL pública)
            $table->string('url_documento', 500);

            // estado: pendiente | publicado | entregado
            $table->string('estado', 20)->default('pendiente')->index();

            $table->timestamp('publicado_at')->nullable();
            $table->timestamp('notificado_at')->nullable();

            $table->timestamps();

            $table->index('pedido_id');
            $table->index('persona_atendida_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados');
    }
};
