<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('Paciente_id');
            $table->timestamps();
            $table->string('dni',9)->unique();
            $table->string('nombre',50)->nullable();
            $table->string('apellido',50)->nullable();
            $table->string('telefono',50)->nullable();
            $table->date('fechaNac')->nullable();
            $table->string('sexo',30);
            $table->string('domicilio',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
