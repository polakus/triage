<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetProfesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_profesionales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_profesional')->references('id')->on('profesionales');
            $table->foreignId('id_especialidad')->references('id')->on('Especialidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_profesionales');
    }
}
