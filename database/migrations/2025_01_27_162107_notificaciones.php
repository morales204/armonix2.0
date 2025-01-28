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
            // Definir la columna id_notificacion como clave primaria autoincrementable
            $table->id('id_notificacion'); 

            // Definir las otras columnas
            $table->string('correo');      // Columna para el correo de la notificación
            $table->string('titulo');      // Columna para el título de la notificación
            $table->text('mensaje');      // Columna para el mensaje de la notificación
            $table->string('estado');     // Columna para el estado de la notificación

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
