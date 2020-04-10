<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsociacionPatientStudent extends Model
{
    public function student()
    {
        return $this->belongsTo('App\User');
    }
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
