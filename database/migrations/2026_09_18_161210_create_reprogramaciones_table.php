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
        Schema::create('reprogramaciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cita_id_original')
                  ->constrained('citas')
                  ->cascadeOnDelete();

            $table->foreignId('cita_id_nueva')
                  ->nullable()
                  ->constrained('citas')
                  ->nullOnDelete();

            // motivo: no_show | solicitud_paciente | problema_lab | clima | otro
            $table->string('motivo', 30)->index();

            $table->decimal('costo_adicional_usd', 10, 2)->default(0);
            $table->boolean('requiere_pago_adicional')->default(false);

            $table->foreignId('pago_adicional_id')
                  ->nullable()
                  ->constrained('pagos')
                  ->nullOnDelete();

            $table->json('politica_aplicada_json')->nullable();

            $table->foreignId('reprogramado_por')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->text('notas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reprogramaciones');
    }
};
