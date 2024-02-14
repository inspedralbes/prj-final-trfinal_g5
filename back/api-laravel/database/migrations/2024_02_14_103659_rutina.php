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
        Schema::create('rutinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuari_id')->constrained('usuaris')->onDelete('cascade');
            $table->string('nombre'); // Cambiado el nombre de la columna para la relación
            $table->foreign('nombre')->references('nombre')->on('ejercicios'); // Definiendo la relación
            $table->string('series')->nullable();
            $table->string('repeticiones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutinas');
    }
};
