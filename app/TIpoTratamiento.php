<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTratamiento extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tratamientos()
    {
        return $this->hasMany('App\Tratamiento');
    }
}
