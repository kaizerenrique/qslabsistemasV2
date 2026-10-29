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
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            $table->foreignId('prueba_id')
                  ->constrained('pruebas')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->unsignedSmallInteger('cantidad')->default(1);
            $table->decimal('precio_usd_snapshot', 10, 2);
            $table->string('nombre_snapshot', 200);
            $table->unsignedSmallInteger('tiempo_entrega_horas_snapshot')->nullable();

            $table->timestamps();

            $table->index('pedido_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_items');
    }
};
