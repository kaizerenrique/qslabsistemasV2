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
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->unique()                      // un user = un lab admin
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('rif', 20)->unique();
            $table->string('nombre', 200);
            $table->string('slug', 220)->unique();
            $table->text('descripcion')->nullable();

            // branding
            $table->string('logo_path', 500)->nullable();
            $table->string('portada_path', 500)->nullable();
            $table->string('sitio_web', 300)->nullable();
            $table->json('redes_json')->nullable();        // {facebook, instagram, ...}

            // verificación y rating
            $table->boolean('verificado')->default(false);
            $table->decimal('rating_promedio', 3, 2)->default(0);
            $table->unsignedInteger('total_resenas')->default(0);

            // domicilio
            $table->boolean('ofrece_domicilio')->default(false);
            $table->decimal('costo_domicilio_usd', 10, 2)->nullable();
            $table->json('zonas_domicilio_json')->nullable();  // ["Baruta","Chacao",...]

            // política de reprogramación
            $table->json('politica_reprogramacion_json')->nullable();

            $table->boolean('activo')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['activo', 'verificado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratorios');
    }
};
