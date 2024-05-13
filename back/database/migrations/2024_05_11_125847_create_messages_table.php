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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_envia_mensaje');
            $table->unsignedBigInteger('usuario_recibe_mensaje');
            $table->string('mensaje')->nullable();
            $table->string('imagen')->nullable();
            $table->string('video')->nullable();
            $table->string('idRutina')->nullable();
            $table->string('idDieta')->nullable();
            $table->boolean('leido');
            $table->timestamps();
            $table->foreign('usuario_envia_mensaje')->references('id')->on('usuaris');
            $table->foreign('usuario_recibe_mensaje')->references('id')->on('usuaris');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
