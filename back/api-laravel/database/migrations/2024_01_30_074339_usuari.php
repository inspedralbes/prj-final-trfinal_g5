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
            $table->string('genere');
            $table->date('data_naixement')->nullable();
            $table->decimal('altura', 10, 2)->default(0);
            $table->decimal('pes', 10, 2)->default(0);
            $table->integer('telefon')->nullable()->default(0); // Ajuste aquí, se permiten valores nulos
            $table->string('foto_perfil')->nullable(); // Ajuste aquí, se permiten valores nulos
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
