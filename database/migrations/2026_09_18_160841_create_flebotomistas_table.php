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
        Schema::create('flebotomistas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('nombre_completo', 200);
            $table->string('cedula', 20);
            $table->string('telefono', 40);

            $table->json('zonas_json')->nullable();         // municipios que cubre
            $table->unsignedSmallInteger('capacidad_diaria')->default(10);
            $table->boolean('activo')->default(true);
            $table->boolean('vehiculo')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['laboratorio_id', 'activo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flebotomistas');
    }
};
