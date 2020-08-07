<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    //
    protected $table="Atencion";

    public function paciente()
    {
        return $this->belongsTo('App\Paciente', 'Paciente_id');
    }

    public function detallehorario()
    {
        return $this->hasMany('App\DetalleHorario');
    }
}
