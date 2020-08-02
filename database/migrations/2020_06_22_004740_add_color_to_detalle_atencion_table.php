<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToDetalleAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_atencion', function (Blueprint $table) {
            //
            $table->foreignId('id_codigo_triage')->references('id')->on('CodigosTriage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_atencion', function (Blueprint $table) {
            //
        });
    }
}
