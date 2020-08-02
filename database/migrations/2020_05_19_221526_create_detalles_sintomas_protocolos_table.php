<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesSintomasProtocolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Detalles_Sintomas_Protocolos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_protocolo')->references('id')->on('Protocolos');
            $table->foreignId('id_sintoma')->references('id')->on('Sintomas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Detalles_Sintomas_Protocolos');
    }
}
