<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_atencion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_atencion')->references('id')->on('atencion')->onDelete('cascade');
            $table->foreignId('id_det_profesional_sala')->nullable()->references('id')->on('det_profesionales_salas')->onDelete('cascade');
            $table->date("fecha");
            $table->string("hora");
            $table->foreignId('id_especialidad')->references('id')->on('especialidades')->onDelete('cascade');
            $table->boolean('atendido');
            $table->string('estado',30);
            $table->foreignId('id_codigo_triage')->references('id')->on('codigostriage')->onDelete('cascade');
            $table->string('sala',30);
            $table->boolean('operar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_atencion');
    }
}
