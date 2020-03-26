<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diente extends Model
{
    protected $fillable = [
        'name','number', 'cuadrante', 'sextante'
    ];
    public function Patinets()
    {
        return $this->belongsTo('App\AsociacionPatientStudent');
    }
    public function AsociacionExamDientes()
    {
        return $this->hasMany('App\AsociacionExamDiente');
    }

}
