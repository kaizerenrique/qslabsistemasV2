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
        Schema::create('muestras', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cita_id')
                  ->constrained('citas')
                  ->cascadeOnDelete();

            $table->foreignId('persona_atendida_id')
                  ->constrained('personas')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('codigo_muestra', 40)->unique();  // MUE-...
            $table->string('tipo', 30);

            $table->timestamp('recolectada_at')->nullable();
            $table->timestamp('recibida_lab_at')->nullable();

            // estado: pendiente | recolectada | recibida | procesando | procesada
            $table->string('estado', 20)->default('pendiente')->index();

            $table->timestamps();

            $table->index('persona_atendida_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muestras');
    }
};
