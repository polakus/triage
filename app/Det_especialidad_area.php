<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Det_especialidad_area extends Model
{
    protected $table = "det_especialidad_area";

    public function area(){
        return $this->belongsTo('App\Area', 'id_area');
    }
    public function especialidad(){
        return $this->belongsTo('App\Especialidad');
    }
    // public function getArea($id_especialidad){
    //     return 
    // }
}
