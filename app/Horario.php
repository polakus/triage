<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    //
    protected $table="Horarios";

    public function salas()
    {
        return $this->belongsTo('App\Sala', 'id_salas');
    }

    public function detallehorario()
    {
        return $this->hasMany('App\DetalleHorario');
    }


    public function medico()
    {
        return $this->belongsTo('App\Medico', 'id_medico');
    }
}
