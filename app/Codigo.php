<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    protected $table = "CodigosTriage";

    public function protocolos()
    {
        return $this->hasMany('App\Protocolo');
    }
}
