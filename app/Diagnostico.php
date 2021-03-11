<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
        'nombre','tipo_id'
    ];
    public function TipoDiagnostico()
    {
        return $this->belongsTo('App\TipoDiagnostico');
    }
    public function AsociacionDiagnosticoExams()
    {
        return $this->hasMany('App\AsociacionDiagnosticoExam');
    }
}
