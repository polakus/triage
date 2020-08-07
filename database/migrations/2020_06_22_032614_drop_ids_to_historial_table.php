<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIdsToHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historial', function (Blueprint $table) {
            //ALTER TABLE mytable DROP FOREIGN KEY mytable_ibfk_1 ; 
            $table->dropForeign(['Paciente_id']);
            $table->dropColumn('Paciente_id');
            $table->dropForeign(['id_profesional']);
            $table->dropColumn('id_profesional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historial', function (Blueprint $table) {
            //
        });
    }
}
