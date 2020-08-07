<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table = "profesionales";
    
    protected $fillable = [
        'nombre', 'apellido', 'matricula', 'domicilio', 'id_user', 'disponibilidad',
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function detalleProfesional(){
        return $this->hasMany('App\DetalleProfesional', 'id_profesional');
    }
}
