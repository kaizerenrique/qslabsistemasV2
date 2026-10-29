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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            $table->decimal('monto_usd', 12, 2);
            $table->decimal('monto_bs', 16, 2);
            $table->decimal('tasa_bcv_aplicada', 12, 4);

            $table->string('moneda', 5);                  // USD | BS
            // metodo: pago_movil | transferencia | zelle |
            //         binance | efectivo | tarjeta
            $table->string('metodo', 30)->index();

            $table->string('referencia', 100)->nullable()->unique();
            $table->string('comprobante_path', 500)->nullable();

            // estado: pendiente | aprobado | rechazado | reembolsado
            $table->string('estado', 20)->default('pendiente')->index();

            $table->foreignId('aprobado_por')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamp('aprobado_at')->nullable();
            $table->json('payload_json')->nullable();

            $table->timestamps();

            $table->index('pedido_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
