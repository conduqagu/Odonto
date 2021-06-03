<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionExamDiente extends Model
{
    protected $fillable = [
        'denticionRaiz','denticionCorona', 'tratamiento ', 'opacidad','exam_id','diente_id','furca',
        'retraccion','hipertrofia','sondaje','movilidad','sangrado','encia_insertada','pin'
    ];
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
    public function diente()
    {
        return $this->belongsTo('App\Diente');
    }
}
