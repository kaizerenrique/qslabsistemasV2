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
        Schema::create('laboratorio_pruebas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->foreignId('prueba_id')
                  ->constrained('pruebas')
                  ->cascadeOnDelete();

            $table->decimal('precio_usd', 10, 2);
            $table->boolean('disponible')->default(true);
            $table->unsignedSmallInteger('tiempo_entrega_horas')->nullable(); // override
            $table->boolean('activo')->default(true);

            $table->timestamps();

            $table->unique(['laboratorio_id', 'prueba_id']);
            $table->index(['laboratorio_id', 'activo', 'disponible']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorio_pruebas');
    }
};
