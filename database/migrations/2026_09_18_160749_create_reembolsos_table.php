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
        Schema::create('reembolsos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->cascadeOnDelete();

            $table->foreignId('pago_id')
                  ->constrained('pagos')
                  ->cascadeOnDelete();

            // tipo: total | parcial
            $table->string('tipo', 15);

            // motivo: rechazo_lab | cancelacion_paciente | no_show |
            //         error_plataforma | prueba_no_realizada | otro
            $table->string('motivo', 40);

            $table->decimal('monto_usd', 12, 2);

            $table->decimal('tasa_bcv_pago_original', 12, 4);
            $table->decimal('tasa_bcv_reembolso', 12, 4)->nullable();
            $table->decimal('monto_bs_reembolso', 16, 2)->nullable();
            $table->decimal('monto_bs_acordado', 16, 2)->nullable();

            $table->json('pedido_items_afectados_json')->nullable();

            // estado: pendiente | en_proceso | completado | rechazado | vencido
            $table->string('estado', 20)->default('pendiente')->index();

            // metodo_devolucion: efectivo | transferencia | zelle | pago_movil | otro
            $table->string('metodo_devolucion', 30)->nullable();
            $table->string('referencia_lab', 100)->nullable();

            $table->text('notas_lab')->nullable();
            $table->text('notas_qslab')->nullable();

            $table->foreignId('iniciado_por')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->boolean('confirmado_por_lab')->default(false);
            $table->timestamp('confirmado_at')->nullable();
            $table->timestamp('completado_at')->nullable();
            $table->timestamp('vence_at');                 // created_at + 5 días hábiles

            $table->timestamps();

            $table->index(['estado', 'vence_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reembolsos');
    }
};
