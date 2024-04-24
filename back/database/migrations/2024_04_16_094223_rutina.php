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
            $table->string('dia')->nullable();
            $table->string('nom_excercici');
            $table->string('series')->nullable();
            $table->string('repeticions')->nullable();
            $table->foreignid('id_exercici')->constrained('ejercicios')->onDelete('cascade');
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
