<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        //Atributos examen:
        'date','costeTotal','patient_id','tipoExam','otros',
        //Atributos exmanen inicial:
        'aspectoExtraoralNormal','cancerOral', 'anomaliasLabios', 'otros','patologiaMucosa','fluorosis','estadoS1',
        'estadoS2','estadoS3','estadoS4','estadoS5','estadoS6','claseAngle','lateralAngle','tipoDentición',
        'apiñamientoIncisivoInferior','apiñamientoIncisivoSuperior','perdidaEspacioAnterior','perdidaEspacioPosterior',
        'mordidaCruzadaAnterior','mordidaCruzadaPosterior','desviacionLineaMedia','mordidaAbierta','habitos',
        //Atributos examen infantil
        'aspectoGeneral','talla','peso','piel','anomaliaForma','anomaliaTamaño',
        //Atributos examen periodontal
        'indicePlaca','color','borde','aspecto','consistencia','biotipo',
        //Atributos Ortodoncia
        'patronFacial','perfil','menton',
        //Atributos Evaluacion
        'previsto','maxilar','mandibular','logrado'


    ];
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    public function AsociacionExamDientes()
    {
        return $this->hasMany('App\AsociacionExamDiente');
    }
    public function asociacionExamTratamientos()
    {
        return $this->hasMany('App\AsociacionExamTratamiento');
    }
    public function PruebaComplementarias()
    {
        return $this->hasMany('App\PruebaComplementaria');
    }
    public function tratamientos()
    {
        return $this->hasMany('App\Tratamiento');
    }
}

