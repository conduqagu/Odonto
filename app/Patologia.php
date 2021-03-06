<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    protected $fillable = [
        'name'
    ];
    public function Diagnosticos()
    {
        return $this->hasMany('App\Diagnostico');
    }
}
