<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleHorario extends Model
{
    protected $table="Detalle_Horarios"; # parece que este model no se usa así que no es necesario cambiar
    public function horario()
    {
        return $this->belongsTo('App\Horario', 'id_horarios');
    }

    public function atencion()
    {
        return $this->belongsTo('App\Atencion', 'id_atencion');
    }
}
