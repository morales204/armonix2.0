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
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_rol'); // Definir la columna 'id_rol' como clave primaria
            $table->string('rol'); // Definir el campo 'rol' para el nombre del rol
            $table->timestamps(); // Campos de timestamp 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
