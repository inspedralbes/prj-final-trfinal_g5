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
        Schema::create('aliments', function (Blueprint $table) {
            $table->id();
            $table->string('nom_plat');
            $table->string('apat');
            $table->json('ingredients');
            // $table->string('nom_ingredient');
            // $table->integer('quantitat');
            // $table->integer('unitat');
            $table->decimal('calories',10 ,2);
            $table->decimal('proteines',10 ,2);
            $table->decimal('carbohidrats',10 ,2);
            $table->decimal('greixos',10 ,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aliments');
    }
};
