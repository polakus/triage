<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'Areas';

    protected $fillable = [
        'tipo_dato',
    ];

    public function salas()
    {
        return $this->hasMany('App\Sala');
    }
}
