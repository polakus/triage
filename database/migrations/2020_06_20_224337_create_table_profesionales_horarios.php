<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProfesionalesHorarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionales_horarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_profesional')->references('id')->on('profesionales');
            $table->time('hr_ini');
            $table->time('hr_fin');
            $table->string('dia', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesionales_horarios');
    }
}
