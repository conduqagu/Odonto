<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionDiagnosticoExam extends Model
{
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
    public function diagnostico()
    {
        return $this->belongsTo('App\Diagnostico');
    }
}
