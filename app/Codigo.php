<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    protected $table = "codigostriage"; #codigostriage con minúscula

    public function protocolos()
    {
        return $this->hasMany('App\Protocolo');
    }
    // public function detalleAtencion()
    // {
    //     return $this->hasMany('App\User');
    // }
}
