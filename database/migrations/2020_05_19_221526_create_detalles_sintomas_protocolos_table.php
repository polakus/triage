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
        Schema::create('detalles_sintomas_protocolos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_protocolo')->references('id')->on('protocolos')->onDelete('cascade');
            $table->foreignId('id_sintoma')->references('id')->on('sintomas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_sintomas_protocolos');
    }
}
