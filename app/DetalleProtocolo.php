<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleProtocolo extends Model
{
    //
    protected $table='det_protocolos';

    public function protocolo(){
    	 return $this->belongsTo('App\Protocolo', 'id_protocolo');
    }
    
    public function especialidad(){
    	 return $this->belongsTo('App\Especialidad', 'id_especialidad');
    }
}
