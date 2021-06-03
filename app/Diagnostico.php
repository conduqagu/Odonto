<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
        'nombre'
    ];

    public function exams () {
        return $this->belongsToMany('App\Exam','diagnostico_exam', 'diagnostico_id', 'exam_id')->withPivot('comentario');
    }
}
