<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('pregunta_secreta')->nullable();
            $table->string('respuesta_secreta')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn(['pregunta_secreta', 'respuesta_secreta']);
        });
    }
    
};
