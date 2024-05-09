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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_envia_solicitud');
            $table->string('usuario_recibe_solicitud');
            $table->timestamps();

            // Define las claves foráneas
            $table->foreign('usuario_envia_solicitud')->references('nom_usuari')->on('usuaris');
            $table->foreign('usuario_recibe_solicitud')->references('nom_usuari')->on('usuaris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituds');
    }
};
