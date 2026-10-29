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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->ulid('codigo')->unique();             // PED-01J8X...

            $table->foreignId('paciente_titular_id')      // quien paga
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('persona_atendida_id')      // quien recibe
                  ->constrained('personas')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('laboratorio_id')
                  ->constrained('laboratorios')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('sucursal_id')
                  ->nullable()
                  ->constrained('laboratorio_sucursales')
                  ->nullOnDelete();

            // modalidad: domicilio | sucursal
            $table->string('modalidad', 20);

            // estado: borrador | pendiente_pago | pagado | agendado |
            //         en_proceso | listo | entregado |
            //         rechazado_lab | cancelado_paciente |
            //         no_show | expirado
            $table->string('estado', 30)->default('borrador')->index();

            $table->decimal('subtotal_usd', 12, 2);
            $table->decimal('costo_domicilio_usd', 10, 2)->default(0);
            $table->decimal('total_usd', 12, 2);

            $table->decimal('tasa_bcv', 12, 4);
            $table->decimal('total_bs', 16, 2);
            $table->timestamp('tasa_valida_hasta');

            $table->foreignId('direccion_id')
                  ->nullable()
                  ->constrained('direcciones_pacientes')
                  ->nullOnDelete();

            $table->text('notas')->nullable();

            $table->timestamps();

            $table->index(['laboratorio_id', 'estado']);
            $table->index(['paciente_titular_id', 'estado']);
            $table->index(['persona_atendida_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
