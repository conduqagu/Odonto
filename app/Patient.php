<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name','surname', 'dni','email', 'telefono','fechaNacimiento','riesgoASA','observaciones'
    ];
    public function asociacionPatientStudents()
    {
        return $this->hasMany('App\AsociacionPatientStudent');
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
