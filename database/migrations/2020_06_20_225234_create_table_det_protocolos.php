<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDetProtocolos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_protocolos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_especialidad')->references('id')->on('Especialidades');
            $table->foreignId('id_protocolo')->references('id')->on('Protocolos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_protocolos');
    }
}
