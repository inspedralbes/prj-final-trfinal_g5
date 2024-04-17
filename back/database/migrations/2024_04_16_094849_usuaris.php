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
            $table->string('nom');
            $table->string('cognoms');
            $table->string('genere')->nullable();
            $table->date('data_naixement')->nullable();
            $table->decimal('altura', 10, 2)->nullable();
            $table->decimal('pes', 10, 2)->nullable();
            $table->string('telefon')->nullable(); 
            $table->string('foto_perfil')->nullable();
            $table->string('alergia/intolerancia')->nullable();
            $table->string ('lesio')->nullable();
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
