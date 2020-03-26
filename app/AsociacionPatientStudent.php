<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionPatientStudent extends Model
{
    public function students()
    {
        return $this->belongsTo('App\User');
    }
    public function patients()
    {
        return $this->belongsTo('App\Patient');
    }
}
