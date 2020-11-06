<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'Especialidades';
    
    public function detalleProfesional(){
        return $this->hasMany('App\DetalleProfesional');
    }
    public function Det_especialidad_area(){
        return $this->hasMany('App\Det_especialidad_area', 'id_especialidad');
    }

    public function detalle_protocolo(){
        return $this->hasMany('App\DetalleProtocolo','id_especialidad');
    }
    public function pa(){
        foreach($this->Det_especialidad_area as $det)
            echo $det->id_area.'<br>';
    }
}
