<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
        'tipo','nombre', 'patologia_id'
    ];
    public function Patologia()
    {
        return $this->belongsTo('App\Patologia');
    }
    public function AsociacionDiagnosticoExams()
    {
        return $this->hasMany('App\AsociacionDiagnosticoExam');
    }
}
