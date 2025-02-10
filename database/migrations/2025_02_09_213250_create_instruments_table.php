<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del instrumento
            $table->string('image')->nullable(); // Imagen opcional
            $table->foreignId('instrument_type_id')->constrained('instrument_types')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instruments');
    }
};
