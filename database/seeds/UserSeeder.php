<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"Alejandro Gonzales",
            "username"=>"admin",
            "email"=>"ale368_dvs@hotmail.com",
            "password"=>Hash::make('asdfñlkj'),
            "estado"=>1,
        ])->assignRole(['Administrador','Profesional']);
        User::create([
            "name"=>"Cristian Zalazar",
            "username"=>"cz",
            "email"=>"cz@gmail.com",
            "password"=>Hash::make('asdfñlkj'),
            "estado"=>1,
        ])->assignRole('Profesional');
        User::create([
            "name"=>"Prueba",
            "username"=>"prueba",
            "email"=>"prueba@gmail.com",
            "password"=>Hash::make('asdfñlkj'),
            "estado"=>0,
        ]);
    }
}
