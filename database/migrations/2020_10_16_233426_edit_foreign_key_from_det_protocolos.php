<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditForeignKeyFromDetProtocolos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('det_protocolos', function (Blueprint $table) {

            #PUEEDE QUE ESTE MIGRATION NO FUNCIONE PORQUE SE EJECUTÓ MEDIO AGARRADO DE LOS PELOS
            // $table->dropForeign(['id_protocolo']);
            $table->foreign('id_protocolo')->references('id')->on('Protocolos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('det_protocolos', function (Blueprint $table) {
            //
        });
    }
}
