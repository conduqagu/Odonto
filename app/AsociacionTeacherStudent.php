<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionTeacherStudent extends Model
{
    public function student()
    {
        return $this->belongsTo('App\User');
    }
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }
}
