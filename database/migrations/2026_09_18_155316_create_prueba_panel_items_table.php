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
        Schema::create('prueba_panel_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('panel_id')
                  ->constrained('pruebas_paneles')
                  ->cascadeOnDelete();

            $table->foreignId('prueba_id')
                  ->constrained('pruebas')
                  ->cascadeOnDelete();

            $table->unsignedSmallInteger('orden')->default(0);

            $table->unique(['panel_id', 'prueba_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prueba_panel_items');
    }
};
