<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('dificultad');
            $table->unsignedBigInteger('idCategoria'); // Cambiando a unsignedBigInteger, que es el tipo recomendado para las claves foráneas.
            $table->string('imagen');
            $table->string('descripcion');
            $table->foreign('idCategoria')->references('idCategoria')->on('categoriasm');
        });
    }
    



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejercicios');
    }
};
