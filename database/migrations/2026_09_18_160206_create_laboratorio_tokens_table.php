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
        Schema::create('laboratorio_tokens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            // referencia al token real de Sanctum
            $table->foreignId('personal_access_token_id')
                  ->constrained('personal_access_tokens')
                  ->cascadeOnDelete();

            $table->string('nombre', 150);          // "Token principal 2025-09"

            $table->foreignId('generado_por')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->json('enviado_a_tecnicos_json')->nullable();

            $table->foreignId('revocado_por')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamp('revocado_at')->nullable();
            $table->text('motivo_revocacion')->nullable();
            $table->boolean('activo')->default(true);

            $table->timestamps();

            $table->index(['laboratorio_id', 'activo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorio_tokens');
    }
};
