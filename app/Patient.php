<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name','surname', 'dni','email', 'telefono','fechaNacimiento','riesgoASA','observaciones','child'
    ];
    public function students () {
        return $this->belongsToMany('App\User','patient_student','patient_id','student_id');
    }
    public function dientes()
    {
        return $this->hasMany('App\Diente');
    }
    public function exams()
    {
        return $this->hasMany('App\Exam');
    }
}
