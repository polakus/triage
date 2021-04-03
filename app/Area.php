<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    // protected $table = 'Areas'; # areas con minúscula

    protected $fillable = [
        'nombre',
    ];

    public function salas()
    {
        return $this->hasMany('App\Sala');
    }
}
