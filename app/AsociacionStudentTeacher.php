<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionStudentTeacher extends Model
{
    public function students()
    {
        return $this->belongsTo('App\User');
    }
    public function teachers()
    {
        return $this->belongsTo('App\User');
    }

}
