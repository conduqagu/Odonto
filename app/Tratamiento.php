<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'nombre','realizado', 'coste','iva', 'cobrado','terapia'
    ];

    public function asociacionExamTratamientos()
    {
        return $this->hasMany('App\AsociacionExamTratamiento');
    }
}
