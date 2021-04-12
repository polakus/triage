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
            "id_rol"=>1,
            "estado"=>1,
        ])->assignRole('Administrador');
        User::create([
            "name"=>"CristianZalazar",
            "username"=>"cz",
            "email"=>"cz@gmail.com",
            "password"=>Hash::make('asdfñlkj'),
            "id_rol"=>2,
            "estado"=>1,
        ])->assignRole('Profesional');
    }
}
