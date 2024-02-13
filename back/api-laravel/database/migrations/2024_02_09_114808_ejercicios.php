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
            $table->string('id');
            $table->string('nombre');
            $table->string('dificultad');
            $table->string('idCategoria');
            $table->string('imagen');
            $table->string('descripcion');
            $table->foreign('idCategoria')->references('idCategoria')->on('categoriasM');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
