<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVoteForeignKeyToDetEspecialidadArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('det_especialidad_area', function (Blueprint $table) {
            $table->dropForeign('det_especialidad_area_id_especialidad_foreign');
            $table->dropForeign('det_especialidad_area_id_area_foreign');
            // $table->dropColumn('id_especialidad');
            // $table->dropColumn('id_area');
            $table->foreign('id_especialidad')->references('id')->on('Especialidades')->onDelete('cascade')->change();
            $table->foreign('id_area')->references('id')->on('Areas')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('det_especialidad_area', function (Blueprint $table) {
            //
        });
    }
}
