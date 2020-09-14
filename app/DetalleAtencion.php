<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAtencion extends Model
{
    //
    protected $table="detalle_atencion";

    public function CodigoTriage()
    {
        return $this->belongsTo('App\Codigo', 'id_codigo_triage');
    }
}
