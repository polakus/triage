<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    //
    // protected $table = "Sintomas"; # sintomas con minuscula

    // protected $fillable = ['descripcion',];

    public function det_sintomas_protocolos()
    {
        return $this->hasMany('App\Detalle_Sintoma_Protocolo', 'id_sintoma');
    }
}
