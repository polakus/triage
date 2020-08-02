<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProfesional extends Model
{
    protected $table = 'det_profesionales';

    // public function profesional(){
    //     return $this->hasOne('App\Profesional');
    // }

    // public function especialidad(){
    //     return $this->hasOne('App\Especialidad');
    // }

    public function profesional(){
        return $this->belongsTo('App\Profesional');
    }

    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad');
    }
}
