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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();

            // destinatario polimórfico (user o laboratorio)
            $table->morphs('notificable');

            // evento: pedido.pagado, cita.creada, resultado.publicado, ...
            $table->string('evento', 60)->index();

            // canal: email | panel | push | whatsapp
            $table->string('canal', 20)->index();

            $table->string('titulo', 200);
            $table->text('mensaje');
            $table->json('datos_json')->nullable();

            // estado: pendiente | enviada | fallida | leida
            $table->string('estado', 20)->default('pendiente')->index();

            $table->timestamp('enviada_at')->nullable();
            $table->timestamp('leida_at')->nullable();
            $table->text('error')->nullable();

            $table->timestamps();

            $table->index(['notificable_type', 'notificable_id', 'estado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
