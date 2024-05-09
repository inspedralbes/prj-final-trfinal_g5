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
            $table->unsignedBigInteger('usuario_envia_id');
            $table->unsignedBigInteger('usuario_recibe_id');
            $table->timestamps();

            // Define las claves foráneas
            $table->foreign('usuario_envia_id')->references('id')->on('usuaris');
            $table->foreign('usuario_recibe_id')->references('id')->on('usuaris');
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
