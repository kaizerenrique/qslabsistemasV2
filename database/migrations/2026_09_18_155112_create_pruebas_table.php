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
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('codigo', 40)->unique();      // código interno Qslab
            $table->string('nombre', 200);
            $table->string('slug', 220)->unique();
            $table->text('descripcion')->nullable();

            // tipo_muestra: sangre | orina | heces | hisopado | saliva | otro
            $table->string('tipo_muestra', 30)->index();
            $table->boolean('requiere_ayuno')->default(false);
            $table->text('preparacion')->nullable();
            $table->unsignedSmallInteger('tiempo_entrega_horas')->nullable();

            $table->boolean('activa')->default(true);

            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['activa', 'categoria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pruebas');
    }
};
