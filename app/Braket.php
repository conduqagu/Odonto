<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Braket extends Model
{
    protected $fillable = [
        'name'
    ];
    public function Tratamientos()
    {
        return $this->hasMany('App\Tratamiento');
    }
}
