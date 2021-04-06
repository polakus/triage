<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class rolesUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'nombre' => 'Administrador',
        ]);
        DB::table('roles')->insert([
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'nombre' => 'Profesional',
        ]);
    }
}
