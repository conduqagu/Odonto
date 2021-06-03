<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        //Atributos examen:
        'date','costeTotal','patient_id','tipoExam','otros','pin',
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
    public function PruebaComplementarias()
    {
        return $this->hasMany('App\PruebaComplementaria');
    }
    public function tratamientos()
    {
        return $this->hasMany('App\Tratamiento');
    }
    public function evOrtos(){
        $this->belongsTo('App\Exam');
    }
    public function ortodoncia(){
        $this->hasMany('App\Exam');
    }
    /**public function AsociacionDiagnosticoExams()
    {
        return $this->hasMany('App\AsociacionDiagnosticoExam');
    }*/
    public function diagnosticos () {
        return $this->belongsToMany('App\Diagnostico','diagnostico_exam', 'exam_id', 'diagnostico_id')->withPivot('comentario');
    }
}

