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
        Schema::create('password_recovery_codes', function (Blueprint $table) {
            $table->id();
            $table->string('recovery_code');
            $table->unsignedBigInteger('usuario_id');  // Definir como unsignedBigInteger
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');  // Relación con 'usuarios' usando 'id_usuario'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_recovery_codes');
    }
};