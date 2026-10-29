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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();

            // Un phone pertenece a una persona O a un laboratorio (no ambos)
            $table->foreignId('persona_id')
                  ->nullable()
                  ->constrained('personas')
                  ->cascadeOnDelete();

            $table->foreignId('laboratorio_id')
                  ->nullable()
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->string('codigo_internacional', 6)->default('+58');
            $table->string('codigo_operador', 6);
            $table->string('nrotelefono', 15);
            $table->boolean('whatsapp')->default(false);

            $table->timestamps();

            $table->index('persona_id');
            $table->index('laboratorio_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
