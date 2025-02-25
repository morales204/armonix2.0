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
            $table->unsignedBigInteger('usuario_id');  // Relación con usuarios
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');  // Clave foránea a la tabla usuarios
            $table->timestamp('expires_at')->nullable();  // Columna para la expiración del código
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
