<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
        'nombre','tipo_diagnostico_id'
    ];
    public function tipo_diagnostico()
    {
        return $this->belongsTo('App\TipoDiagnostico');
    }
    /**public function AsociacionDiagnosticoExams()
    {
        return $this->hasMany('App\AsociacionDiagnosticoExam');
    }*/
    public function exams () {
        return $this->belongsToMany('App\Exam','diagnostico_exam', 'diagnostico_id', 'exam_id');
    }
}
