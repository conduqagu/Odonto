<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'realizado', 'coste','iva', 'cobrado','terapia','braket_id','duracionEstimada','tipo_tratamiento_id','exam_id'
    ];

    public function asociacionExamTratamientos()
    {
        return $this->hasMany('App\AsociacionExamTratamiento');
    }
    public function braket()
    {
        return $this->belongsTo('App\Braket');
    }
    public function tipoTratamiento()
    {
        return $this->belongsTo('App\TipoTratamiento');
    }
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

}
