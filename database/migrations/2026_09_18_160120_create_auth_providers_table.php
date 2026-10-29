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
        Schema::create('auth_providers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('provider', 30);            // facebook | google | ...
            $table->string('provider_id', 200);
            $table->string('nickname', 200)->nullable();
            $table->string('avatar', 500)->nullable();
            $table->text('token')->nullable();
            $table->dateTime('login_at')->nullable();

            $table->timestamps();

            $table->unique(['provider', 'provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_providers');
    }
};
