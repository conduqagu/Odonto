<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionExamDiente extends Model
{
    public function exams()
    {
        return $this->belongsTo('App\Exam');
    }
    public function dientes()
    {
        return $this->belongsTo('App\Diente');
    }
}
