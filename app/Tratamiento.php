<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'nombre','realizado', 'coste','iva', 'cobrado','terapia','brakets_id','duracionEstimada'
    ];

    public function asociacionExamTratamientos()
    {
        return $this->hasMany('App\AsociacionExamTratamiento');
    }
    public function Braket()
    {
        return $this->belongsTo('App\Braket');
    }
}
