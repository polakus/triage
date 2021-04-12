<?php

use Illuminate\Database\Seeder;
use App\Sala;
use App\Area;

class SalaAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area1 = Area::create(["nombre"=> "Area 1"]);
        $area2 = Area::create(["nombre"=> "Area 2"]);
        $area3 = Area::create(["nombre"=> "Area 3"]);
        
        Sala::create(["nombre"=>"Sala 1", "id_area"=>$area1->id, "disponibilidad"=>1,"camas"=>5]);
        Sala::create(["nombre"=>"Sala 2", "id_area"=>$area1->id, "disponibilidad"=>1,"camas"=>5]);
        Sala::create(["nombre"=>"Sala 3", "id_area"=>$area2->id, "disponibilidad"=>1,"camas"=>5]);
        Sala::create(["nombre"=>"Sala 4", "id_area"=>$area2->id, "disponibilidad"=>1,"camas"=>5]);
        Sala::create(["nombre"=>"Sala 5", "id_area"=>$area3->id, "disponibilidad"=>1,"camas"=>5]);
        Sala::create(["nombre"=>"Sala 6", "id_area"=>$area3->id, "disponibilidad"=>1,"camas"=>5]);
    }
}
