<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Paciente;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genero = array('Masculino','Femenino');
        for ($j=0; $j < 6; $j++) { 
            $pacientes = [];
            for ($i=0; $i < 5000; $i++) {
                $array = [
                    'dni'=>rand(10000000,99999999),
                    'sexo'=>$genero[array_rand($genero)],
                    'nombre'=>Str::random(20),
                    'apellido'=>Str::random(20),
                    'domicilio'=>Str::random(30),
                    'telefono'=>rand(10000000000,99999999999),
                    'fechaNac'=>date("Y-m-d",mt_rand(1, time())),
                ];
                array_push($pacientes, $array);
            }
            DB::table('pacientes')->insertOrIgnore($pacientes);
        }
    }
}
