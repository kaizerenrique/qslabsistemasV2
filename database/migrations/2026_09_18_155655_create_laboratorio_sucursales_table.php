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
        Schema::create('laboratorio_sucursales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->string('nombre', 150);
            $table->string('direccion', 500);
            $table->string('municipio', 120)->nullable();
            $table->string('estado', 120)->nullable();      // estado geográfico
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('telefono', 40)->nullable();
            $table->json('horario_json')->nullable();       // {"lun_vie":"8-17","sab":"8-12"}
            $table->boolean('activa')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['laboratorio_id', 'activa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorio_sucursales');
    }
};
