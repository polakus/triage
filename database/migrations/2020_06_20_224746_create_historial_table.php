<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('Paciente_id')->references('Paciente_id')->on('Pacientes');
            $table->foreignId('id_profesional')->references('id')->on('profesionales');
         
            $table->foreignId('id_cie')->references('id')->on('cie');
            $table->string('descripcion',250);
            $table->datetime('fecha_hora');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial');
    }
}
