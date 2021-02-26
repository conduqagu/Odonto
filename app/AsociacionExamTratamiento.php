<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionExamTratamiento extends Model
{
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
    public function tratamiento()
    {
        return $this->belongsTo('App\Tratamiento');
    }
}
