<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'date','aspectoExtraoralNormal','cancerOral', 'anomaliasLabios', 'otros','patologiaMucosa','fluorosis','claseAngle',
        'lateralAngle','tipoDentición','apiñamientoIncisivoInferior','apiñamientoIncisivoSuperior','perdidaEspacioAnterior',
        'perdidaEspacioPosterior','mordidaCruzadaAnterior','mordidaCruzadaPosterior','desviacionLineaMedia','mordidaAbierta',
        'habitos'
    ];
    public function Patinets()
    {
        return $this->belongsTo('App\AsociacionPatientStudent');
    }
    public function AsociacionExamDientes()
    {
        return $this->hasMany('App\AsociacionExamDiente');
    }

}
