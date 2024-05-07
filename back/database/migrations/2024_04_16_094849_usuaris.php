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
        Schema::create('usuaris', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('contrasenya');
            $table->string('nom_usuari')->unique();
            $table->string('nom');
            $table->string('cognoms')->nullable();
            $table->string('genere')->nullable();
            $table->date('data_naixement')->nullable();
            $table->integer('altura')->nullable();
            $table->decimal('pes', 10, 2)->nullable();
            $table->string('telefon')->nullable(); 
            $table->string('foto_perfil')->default('usuario.png');
            $table->string('alergia_intolerancia')->nullable();
            $table->string ('lesio')->nullable();
            $table->boolean('registre')->default(false);
            $table->unsignedBigInteger('idRutina')->nullable();
            $table->unsignedBigInteger('idDieta')->nullable();
            $table->foreign('idRutina')->references('id')->on('rutinas');
            $table->foreign('idDieta')->references('id')->on('dietas');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuaris');
    }
};
