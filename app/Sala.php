<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    // protected $table = "salas"; #Si empieza a fallar, descomentar esta linea

    protected $fillable = [
        'nombre', 'camas', 'id_area', 'disponibilidad',
    ];

    public function area()
    {
        return $this->belongsTo('App\Area', 'id_area');
    }
    public function especialidad()
    {
        return $this->belongsTo('App\Especialidad', 'id_especialidades');
    }

    public function horario()
    {
        return $this->hasMany('App\Horario');
    }
}
