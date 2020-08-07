<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Sintoma_Protocolo extends Model
{
    //
    protected $table="Detalles_Sintomas_Protocolos";

    public function protocolo()
    {
        return $this->belongsTo('App\Protocolo', 'id_protocolo');
    }

    public function sintoma()
    {
        return $this->belongsTo('App\Sintoma', 'id_sintoma');
    }
}
