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
        Schema::create('direcciones_pacientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('alias', 80);                 // "Casa", "Oficina"
            $table->string('direccion', 500);
            $table->string('municipio', 120)->nullable();
            $table->string('estado', 120)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->text('referencia')->nullable();
            $table->boolean('principal')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'principal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones_pacientes');
    }
};
