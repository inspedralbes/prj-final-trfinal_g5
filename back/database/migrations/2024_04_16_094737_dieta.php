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
        Schema::create('dietas', function (Blueprint $table) {
            $table->id();
            $table->string('id_usuari');
            $table->string('nom_plat')->constrained('aliments')->onDelete('cascade');
            $table->date('data_inici');
            $table->date('data_fi')->nullable();
            // $table->text('aliments_permesos')->nullable();
            // $table->text('aliments_restringits')->nullable();
            $table->string('apat')->nullable();
            $table->json('ingredients')->nullable();
            $table->integer('calories')->nullable();
            $table->decimal('proteines', 10, 2)->nullable();
            $table->decimal('carbohidrats', 10, 2)->nullable();
            $table->decimal('grases', 10, 2)->nullable();

        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dietas');
    }
};
