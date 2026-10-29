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
        Schema::create('solicitudes_pruebas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->foreignId('categoria_sugerida_id')
                  ->nullable()
                  ->constrained('categorias')
                  ->nullOnDelete();

            $table->string('nombre_sugerido', 200);
            $table->text('descripcion')->nullable();
            $table->string('tipo_muestra_sugerido', 30)->nullable();
            $table->text('justificacion')->nullable();

            // estado: pendiente | aprobada | rechazada
            $table->string('estado', 20)->default('pendiente')->index();

            $table->text('respuesta_qslab')->nullable();

            $table->foreignId('prueba_id_creada')
                  ->nullable()
                  ->constrained('pruebas')
                  ->nullOnDelete();

            $table->foreignId('revisado_por')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamp('revisado_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_pruebas');
    }
};
