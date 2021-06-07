<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'coste','iva','terapia','braket_id','tipo_tratamiento_id','exam_id','fecha_inicio','fecha_fin','asociacion_exam_diente_id'
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
    public function asociacion_exam_diente()
    {
        return $this->belongsTo('App\AsociacionExamDiente');
    }

}
