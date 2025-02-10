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
        Schema::create('submodulos', function (Blueprint $table) {
            $table->id('id_sub');
            $table->string('nombre_sub');
            // Definir la columna como unsignedBigInteger para coincidir con 'id_modulo' en 'modulos'
            $table->unsignedBigInteger('modulo_id_modulo');
            
            // Definir la clave foránea apuntando a 'id_modulo' en lugar de 'id'
            $table->foreign('modulo_id_modulo')->references('id_modulo')->on('modulos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submodulos');
    }
};
