<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditForeignKeyFromDetProfesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('det_profesionales', function (Blueprint $table) {
            $table->dropForeign('det_profesionales_id_profesional_foreign');
            $table->foreign('id_profesional')->references('id')->on('profesionales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('det_profesionales', function (Blueprint $table) {
            //
        });
    }
}
