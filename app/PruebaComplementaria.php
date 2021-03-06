<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaComplementaria extends Model
{
    protected $fillable = [
        'nombre', 'fichero','comentario','exam_id'
    ];
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
