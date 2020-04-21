<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diente extends Model
{
    protected $fillable = [
        'name','number', 'cuadrante', 'sextante','patient_id'
    ];
    public function Patinet()
    {
        return $this->belongsTo('App\AsociacionPatientStudent');
    }
    public function AsociacionExamDientes()
    {
        return $this->hasMany('App\AsociacionExamDiente');
    }

}
