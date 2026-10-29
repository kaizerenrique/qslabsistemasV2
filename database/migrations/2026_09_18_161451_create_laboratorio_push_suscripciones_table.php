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
        Schema::create('laboratorio_push_suscripciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnDelete();

            $table->string('nombre', 150);                  // "Software principal"
            $table->string('endpoint_url', 500);
            $table->string('secret', 100);
            $table->json('eventos_json');                   // ["pedido.pagado", ...]

            $table->boolean('activa')->default(true);
            $table->timestamp('ultimo_ping_at')->nullable();
            $table->unsignedSmallInteger('fallos_consecutivos')->default(0);

            $table->timestamps();

            $table->index(['laboratorio_id', 'activa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorio_push_suscripciones');
    }
};
