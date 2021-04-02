<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    //
    protected $table="Medicos"; # parece qu este model no se usa así que no es necesario cambiar

    public function horario()
    {
        return $this->hasMany('App\horario');
    }
}
