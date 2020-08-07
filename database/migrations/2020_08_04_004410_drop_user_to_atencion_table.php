<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserToAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Atencion', function (Blueprint $table) {
            //
            $table->dropForeign('atencion_usuario_id_foreign');
            $table->dropColumn("usuario_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Atencion', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("usuario_id");
            $table->foreign("usuario_id")
                ->references("id")
                ->on("users")
                ->onUpdate("cascade")
                ->onDelete("cascade");
        });
    }
}
