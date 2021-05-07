<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            RoleSeeder::class,
            codigosTriage::class,
            //UserSeeder::class,
            SalaAreaSeeder::class,
            SintomasSeeder::class,
            EspecialidadesSeeder::class,
            //ProfesionalesSeeder::class,
            PacientesSeeder::class,
        ]);
    }
}
