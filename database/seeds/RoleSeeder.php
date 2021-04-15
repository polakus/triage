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
        ### ROLES PREDETERMINADOS ###
        $admin=Role::create(['name'=>'Administrador']); // Puede hacer todo menos modificar 'Superusuario'
        $prof=Role::create(['name'=>'Profesional']); // No puede hacer casi nada ( rol predeterminado )

        Role::create(['name'=>'Empleado1']);
        Role::create(['name'=>'Empleado2']);
        Role::create(['name'=>'Empleado3']);
        
        #Permisos de pacientes
        Permission::create(['name'=>"VerPacientes"]);
        Permission::create(['name'=>"FullPaciente"])->syncRoles($admin);
        Permission::create(['name'=>"RegistrarPaciente"]);
        Permission::create(['name'=>"RegistrarPacienteNN"]);
        Permission::create(['name'=>"EditarPaciente"]);
        Permission::create(['name'=>"TriajePaciente"]);

        #Permisos de Sintomas
        Permission::create(['name'=>"RegistrarSintoma"]);
        Permission::create(['name'=>"EditarSintoma"]);
        Permission::create(['name'=>"EliminarSintoma"]);
        Permission::create(['name'=>"VerSintoma"]);
        Permission::create(['name'=>"FullSintoma"])->syncRoles($admin);

        #Permiso de CIE
        Permission::create(['name'=>"RegistrarCie"]);
        Permission::create(['name'=>"EditarCie"]);
        Permission::create(['name'=>"EliminarCie"]);
        Permission::create(['name'=>"VerCie"]);
        Permission::create(['name'=>"FullCie"])->syncRoles($admin);
        
        #Permisos de Sala
        Permission::create(['name'=>"FullSalas"])->syncRoles($admin);        
        Permission::create(['name'=>"VerSalasAreas"])->syncRoles([$admin,$prof]);
        Permission::create(['name'=>"RegistrarSala"])->syncRoles($admin);
        Permission::create(['name'=>"RegistrarArea"])->syncRoles($admin);
        Permission::create(['name'=>"EditarArea"])->syncRoles($admin);
        Permission::create(['name'=>"EliminarSala"])->syncRoles($admin);
        Permission::create(['name'=>"EliminarArea"])->syncRoles($admin);
        Permission::create(['name'=>"HabilitarSala"])->syncRoles($admin);

        #Permisos protocolos
        Permission::create(['name'=>"FullProtocolos"])->syncRoles($admin);        
        Permission::create(['name'=>"VerProtocolos"])->syncRoles([$admin,$prof]);
        Permission::create(['name'=>"RegistrarProtocolo"])->syncRoles($admin);
        Permission::create(['name'=>"EditarProtocolo"])->syncRoles($admin);
        Permission::create(['name'=>"EliminarProtocolo"])->syncRoles($admin);

        #Permisos especialidades
        Permission::create(['name'=>"FullEspecialidades"])->syncRoles($admin);        
        Permission::create(['name'=>"VerEspecialidades"])->syncRoles([$admin,$prof]);
        Permission::create(['name'=>"RegistrarEspecialidad"])->syncRoles($admin);
        Permission::create(['name'=>"EditarEspecialidad"])->syncRoles($admin);
        Permission::create(['name'=>"EliminarEspecialidad"])->syncRoles($admin);

        #Permisos usuarios
        Permission::create(['name'=>"FullUsuarios"])->syncRoles($admin);        
        Permission::create(['name'=>"VerUsuarios"])->syncRoles([$admin,$prof]);
        Permission::create(['name'=>"RegistrarUsuario"])->syncRoles($admin);
        Permission::create(['name'=>"ModificarRolesUsuario"])->syncRoles($admin);
        Permission::create(['name'=>"AdministrarUsuarios"])->syncRoles($admin);
        Permission::create(['name'=>"EliminarUsuario"])->syncRoles($admin);

        #AtencionClinica
        Permission::create(['name'=>"SalaAtencionClinica"]);
        Permission::create(['name'=>"VerAtencionClinica"]);
        Permission::create(['name'=>"FullAtencionClinica"])->syncRoles($admin);

        #Atenciones
        Permission::create(['name'=>"VerAtencion"]);
        Permission::create(['name'=>"FullAtencion"])->syncRoles($admin);
        Permission::create(['name'=>"InternacionAtencion"]);
        Permission::create(['name'=>"OperacionAtencion"]);
        Permission::create(['name'=>"DarAltaAtencion"]);
          
    }
}
