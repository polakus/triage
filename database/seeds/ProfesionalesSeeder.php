<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\User;
use App\Profesional;

class ProfesionalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['name' => 'taylor', 'email' => 'taylor@example.com'],
            ['name' => 'dayle', 'email' => 'dayle@example.com'],
          ];

  DB::table('users')->insertOrIgnore($array);
        for ($i=0; $i < 10; $i++) { 
            $exito = true;
            try {
                $user = User::create([
                    // 'id'=>$i+5,
                    'name'=> Str::random(10),
                    'username'=> Str::random(8),
                    'email'=> Str::random(10).'@gmail.com',
                    'password'=> Hash::make('password'),
                    'estado'=> 1,
                ]);
            } catch (QueryException $th) {
                $exito = false;
            }
            if($exito){
                Profesional::create([
                    'documento'=>rand(10000000,99999999),
                    'matricula'=>rand(1,9999),
                    'nombre'=>Str::random(10),
                    'apellido'=>Str::random(10),
                    'domicilio'=>Str::random(20),
                    'telefono'=>rand(10000000000,99999999999),
                    'disponibilidad'=>1,
                    'id_user'=>$user->id,
                ]);
            }
        }

    }
}
