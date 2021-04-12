<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1=Role::create(['name'=>'Administrador']);
        $role2=Role::create(['name'=>'Profesional']);

        Permission::create(['name'=>"VerPacientes"])->syncRoles($role1);
        Permission::create(['name'=>"FullPaciente"])->syncRoles($role1);
        Permission::create(['name'=>"RegistrarPaciente"]);
        Permission::create(['name'=>"RegistrarPacienteNN"]);
        Permission::create(['name'=>"CrearPaciente"]);

        Permission::create(['name'=>"FullSalas"])->syncRoles($role1);        
        Permission::create(['name'=>"VerSalasAreas"])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>"RegistrarSala"])->syncRoles($role1);
        Permission::create(['name'=>"RegistrarArea"])->syncRoles($role1);
        Permission::create(['name'=>"EditarArea"])->syncRoles($role1);
        Permission::create(['name'=>"EliminarSala"])->syncRoles($role1);
        Permission::create(['name'=>"EliminarArea"])->syncRoles($role1);
        Permission::create(['name'=>"HabilitarSala"])->syncRoles($role1);
    }
}
