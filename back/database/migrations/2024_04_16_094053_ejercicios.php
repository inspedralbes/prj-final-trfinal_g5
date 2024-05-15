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
            $table->string('nom_exercici')->unique();
            $table->string('dificultat');
            $table->string('imatge');
            $table->string('descripció');
            $table->string('link');
            // $table->foreign('idCategoria')->references('idCategoria')->on('categoriasm');
            $table->foreignId('idCategoria')->constrained('categoriasm')->onDelete('cascade');
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
