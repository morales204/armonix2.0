<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('cursos')) {
            Schema::create('cursos', function (Blueprint $table) {
                $table->id('id_curso');
                $table->string('nombre');
                $table->string('descripcion');
                $table->string('fecha_inicio');
                $table->string('fecha_fin');
                $table->integer('duracion')->nullable();
                $table->foreignId('usuarios_id_usuario')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
