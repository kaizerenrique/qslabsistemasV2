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
        Schema::create('accesos_resultados', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resultado_id')
                  ->constrained('resultados')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->string('ip', 45)->nullable();
            $table->string('user_agent', 500)->nullable();

            // tipo_acceso: qr | panel | api
            $table->string('tipo_acceso', 20);

            $table->timestamp('created_at')->useCurrent();

            $table->index(['resultado_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accesos_resultados');
    }
};
