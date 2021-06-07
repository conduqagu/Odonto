<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionExamDiente extends Model
{
    protected $fillable = [
        'denticionRaiz','denticionCorona', 'opacidad','exam_id','diente_id','furca',
        'retraccion','hipertrofia','sondaje','movilidad','sangrado','encia_insertada','teacher_id'
    ];
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
    public function diente()
    {
        return $this->belongsTo('App\Diente');
    }
    public function teacher(){
        return $this->hasMany('App\User');
    }
    public function tratamiento()
    {
        return $this->hasMany('App\Tratamiento');
    }
}
