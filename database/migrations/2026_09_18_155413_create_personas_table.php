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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->nullable()
                  ->unique()                       // un user = una persona propia
                  ->constrained('users')
                  ->nullOnDelete();

            $table->string('nacionalidad', 1)->nullable();  // V | E | null (MSC)
            $table->string('cedula', 20)->unique();         // V12345678 | MSC-XXXXXXXX
            $table->string('nombres', 120);
            $table->string('apellidos', 120);
            $table->date('fnacimiento')->nullable();

            // sexo: Femenino | Masculino | Otro
            $table->string('sexo', 20)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('nombres');
            $table->index('apellidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
