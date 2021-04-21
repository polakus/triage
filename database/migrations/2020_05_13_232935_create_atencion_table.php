<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('dias');
            $table->integer('horas');
            $table->foreignId('id_protocolo')->nullable()->references('id')->on('protocolos')->onDelete('cascade');
            $table->foreignId('Paciente_id')->references('Paciente_id')->on('pacientes')->onDelete('cascade');
            $table->foreignId("usuario_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atencion');
    }
}
