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
        Schema::create('categoriasm', function (Blueprint $table) {
            $table->bigIncrements('idCategoria'); // Usamos bigIncrements para definir la columna idCategoria como clave primaria autoincremental.
            $table->string('nombre');
            $table->string('imagenCategoria');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoriasM');

    }
};
