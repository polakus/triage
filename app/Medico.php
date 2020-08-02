<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    //
    protected $table="Medicos";

    public function horario()
    {
        return $this->hasMany('App\horario');
    }
}
