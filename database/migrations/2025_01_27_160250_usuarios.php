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
        Schema::create('usuarios', function (Blueprint $table) {
            // Definir la clave primaria personalizada
            $table->id('id_usuario'); // Establecer la columna id_usuario como clave primaria

            // Definir los campos de la tabla según el modelo
            $table->string('nombre_completo');
            $table->string('telefono');
            $table->string('correo')->unique(); // Correo único
            $table->string('username')->unique(); // Nombre de usuario único
            $table->string('password'); // Contraseña (será hasheada por bcrypt)

            // Relación con roles (esto asume que tienes una tabla 'roles' y el campo 'roles_id_rol')
            $table->unsignedBigInteger('roles_id_rol');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
