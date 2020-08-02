<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    protected $table ='Pacientes';
    protected $primaryKey = "Paciente_id";

    public function atencion()
    {
        return $this->hasMany('App\Atencion');
    }


}
