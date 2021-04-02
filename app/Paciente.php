<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    // protected $table ='Pacientes'; # es paciente con minuscula
    protected $primaryKey = "Paciente_id";

    protected $fillable = ['dni', 'nombre', 'apellido', 'telefono', 'fechaNac', 'sexo', 'domicilio',];

    public function atencion()
    {
        return $this->hasMany('App\Atencion');
    }


}
