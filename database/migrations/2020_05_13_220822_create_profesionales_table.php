<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('documento')->unique();
            $table->string("matricula",20)->unique();
            $table->string("nombre",20);
            $table->string("apellido",20);
            $table->string("domicilio",255);
            $table->string("telefono",20);
            $table->boolean("disponibilidad");
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesionales');
    }
}
