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
            $table->foreignId('id_atencion')->references('id')->on('Atencion');
            $table->foreignId('id_det_profesional_sala')->references('id')->on('det_profesionales_salas');
            $table->date("fecha");
            $table->string("hora");
            
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
