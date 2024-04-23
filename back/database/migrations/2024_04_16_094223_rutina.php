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
            $table->foreignid('ejercicio_id')->constrained('ejercicios')->onDelete('cascade');
            $table->string('nomExecercici');
            $table->string('dia')->nullable();
            $table->string('series')->nullable();
            $table->string('repeticions')->nullable();
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
