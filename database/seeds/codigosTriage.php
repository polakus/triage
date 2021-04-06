<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class codigosTriage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codigostriage')->insert([
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'color' => 'rojo',
            'tiempo_espera' => '1',
        ]);
        DB::table('codigostriage')->insert([
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'color' => 'amarillo',
            'tiempo_espera' => '10',
        ]);
        DB::table('codigostriage')->insert([
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'color' => 'verde',
            'tiempo_espera' => '20',
        ]);
    }
}
