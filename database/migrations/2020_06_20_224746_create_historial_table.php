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
            $table->foreignId('id_detalle_atencion')->references('id')->on('detalle_atencion')->onDelete('cascade');
            $table->foreignId('id_cie')->references('id')->on('cie')->onDelete('cascade');
            $table->string('descripcion',250);
            $table->date("fecha");
            $table->time("hora");
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
