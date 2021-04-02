<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
    //
    // protected $table="Protocolos"; # protocolos con minúscula

    // protected $fillable = ['descripcion',];
    
    public function det_sintomas_protocolos()
    {
        return $this->hasMany('App\Detalle_Sintoma_Protocolo', 'id_protocolo');
    }
    
    public function codigo()
    {
        return $this->belongsTo('App\Codigo', 'id_codigo_triage');
    }

    public function detalle_protocolo(){
        return $this->hasMany('App\DetalleProtocolo','id_protocolo');
    }
}
