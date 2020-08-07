<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'Especialidades';
    
    public function detalleProfesional(){
        return $this->hasMany('App\DetalleProfesional', 'id_especialidad');
    }
}
