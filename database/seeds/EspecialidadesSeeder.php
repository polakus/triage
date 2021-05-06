<?php

use Illuminate\Database\Seeder;
use App\Especialidad;
use App\Det_especialidad_area;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especialidad::create(['id'=> 1 , 'nombre'=>'AUX. DE ANESTESIA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 2 , 'nombre'=>'AUX. DE ENFERMERIA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 3 , 'nombre'=>'TEC. EN LABORATORIO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 4 , 'nombre'=> 'BIOQUIMICO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 5 , 'nombre'=>'TEC. EN CITOLOGIA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 6 , 'nombre'=>'ENFERMERIA PROF.', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 7 , 'nombre'=>'FARMACEUTICO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 8 , 'nombre'=>'TEC. EN HEMOTERAPIA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 9 , 'nombre'=>'INSTRUM. QUIR�RGICO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 10 , 'nombre'=>'LIC. EN ENFERMERIA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 11 , 'nombre'=>'FONOAUDIOLOGO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 12 , 'nombre'=>'KINESIOLOGO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 13 , 'nombre'=>'NUTRICIONISTA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 14 , 'nombre'=>'MEDICO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 15 , 'nombre'=>'MUSICOTERAPEUTA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 16 , 'nombre'=>'OBSTETRICO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 17 , 'nombre'=>'ODONTOLOGO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 18 , 'nombre'=>'TEC. PROT. Y ORTESIS', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 19 , 'nombre'=>'TEC. OPTICO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 20 , 'nombre'=>'MECANICO DENTAL', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 21 , 'nombre'=>'PSICOPEDAGOGO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 22 , 'nombre'=>'PODOLOGO', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 23 , 'nombre'=>'TEC. EN RADIOLOGIA', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 24 , 'nombre'=>'TERAP. OCUPACIONAL', 'descripcion'=>'Agregar descripción']);
        Especialidad::create(['id'=> 25 , 'nombre'=>'AG. DE PROP. MEDICA', 'descripcion'=>'Agregar descripción']);
        Det_especialidad_area::create(['id_especialidad'=>1, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>2, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>3, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>4, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>5, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>6, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>7, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>8, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>9, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>10, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>12, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>13, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>14, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>15, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>16, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>17, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>11, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>18, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>19, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>20, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>21, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>22, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>23, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>24, 'id_area'=>rand(1,3)]);
        Det_especialidad_area::create(['id_especialidad'=>25, 'id_area'=>rand(1,3)]);
        
        
    }
}
