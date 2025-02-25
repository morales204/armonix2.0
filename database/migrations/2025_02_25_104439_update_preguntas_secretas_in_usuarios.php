<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Renombrar las columnas existentes
        DB::statement('ALTER TABLE usuarios CHANGE pregunta_secreta pregunta_secreta_1 VARCHAR(255) NULL');
        DB::statement('ALTER TABLE usuarios CHANGE respuesta_secreta respuesta_secreta_1 VARCHAR(255) NULL');

        // Agregar nuevas columnas
        Schema::table('usuarios', function ($table) {
            $table->string('pregunta_secreta_2')->nullable();
            $table->string('respuesta_secreta_2')->nullable();
        });
    }

    public function down()
    {
        // Restaurar nombres originales
        DB::statement('ALTER TABLE usuarios CHANGE pregunta_secreta_1 pregunta_secreta VARCHAR(255) NULL');
        DB::statement('ALTER TABLE usuarios CHANGE respuesta_secreta_1 respuesta_secreta VARCHAR(255) NULL');

        // Eliminar las nuevas columnas
        Schema::table('usuarios', function ($table) {
            $table->dropColumn(['pregunta_secreta_2', 'respuesta_secreta_2']);
        });
    }
};
