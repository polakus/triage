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
        return $this->hasMany('App\Det_epecialidad_area');
    }
}
