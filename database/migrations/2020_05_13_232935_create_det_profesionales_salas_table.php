<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetProfesionalesSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_profesionales_salas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_profesional')->references('id')->on('profesionales');
            $table->foreignId('id_sala')->references('id')->on('salas');
            $table->boolean("disponibilidad");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_profesionales_salas');
    }
}
