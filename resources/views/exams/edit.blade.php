@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar diente</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::model($exam, [ 'route' => ['exams.update',$exam->id], 'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!! Form::label('date', 'Fecha') !!}
                            {!! Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('aspectoExtraoralNormal' , 'Aspecto Extraoral Normal') !!}
                            {!! Form::select('aspectoExtraoralNormal', array('1'=>'Si','0'=>'No'),'1',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('cancerOral' , 'Cancer Oral') !!}
                            {!! Form::select('cancerOral', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('anomaliasLabios' , 'Anomalias en labios') !!}
                            {!! Form::select('anomaliasLabios', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros') !!}
                            {!! Form::text('otros', null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('patologiaMucosa' , 'Patologías en mucosas') !!}
                            {!! Form::select('patologiaMucosa', array('Ninguna','Tumor maligno','leucoplasia','Liquen plano'),'Ninguna',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('fluorosis' , 'Fluorosis') !!}
                            {!! Form::select('fluorosis', array('Normal','Discutible','Muy ligera','Ligera',
                                  'Moderada','Intensa','Excluida','No registrada'),'Normal',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('estadoS1' , 'Estado primer sextante') !!}
                            {!! Form::select('estadoS1', array('sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'),'sano',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('estadoS1' , 'Estado segundo sextante') !!}
                            {!! Form::select('estadoS1', array('sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'),'sano',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('estadoS1' , 'Estado tercer sextante') !!}
                            {!! Form::select('estadoS1', array('sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'),'sano',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('estadoS1' , 'Estado cuarto sextante') !!}
                            {!! Form::select('estadoS1', array('sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'),'sano',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('estadoS1' , 'Estado quinto sextante') !!}
                            {!! Form::select('estadoS1', array('sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'),'sano',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('estadoS1' , 'Estado sexto sextante') !!}
                            {!! Form::select('estadoS1', array('sano','hemorragia','tártaro','bolsa 4-5 mm', 'Bolsa de 6 mm o más','excluido'),'sano',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('claseAngle' , 'Angle') !!}
                            {!! Form::select('claseAngle', array('clase I', 'clase II', 'clase III'),'clase I',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('lateralAngle' , 'Lateral Angle') !!}
                            {!! Form::select('lateralAngle', array('Unilateral', 'Bilateral'),'Unilateral',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('tipoDentición' , 'Tipo Dentición') !!}
                            {!! Form::select('tipoDentición', array('Temporal', 'Mixta'),'Temporal',['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('apiñamientoIncisivoInferior' , 'Apiñamiento Incisivo Inferior') !!}
                            {!! Form::select('apiñamientoIncisivoInferior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('apiñamientoIncisivoSuperior' , 'Apiñamiento Incisivo Superior') !!}
                            {!! Form::select('apiñamientoIncisivoSuperior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('perdidaEspacioAnterior' , 'Perdida Espacio Anterior') !!}
                            {!! Form::select('perdidaEspacioAnterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('perdidaEspacioPosterior' , 'Perdida Espacio Posterior') !!}
                            {!! Form::select('perdidaEspacioPosterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('mordidaCruzadaAnterior' , 'Mordida Cruzada Anterio') !!}
                            {!! Form::select('mordidaCruzadaAnterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('mordidaCruzadaPosterior' , 'Mordida Cruzada Posterior') !!}
                            {!! Form::select('mordidaCruzadaPosterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('desviacionLineaMedia' , 'Desviacion Linea Media') !!}
                            {!! Form::select('desviacionLineaMedia', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('mordidaAbierta' , 'Mordida Abierta') !!}
                            {!! Form::select('mordidaAbierta', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('habitos' , 'Hábitos') !!}
                            {!! Form::select('habitos', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('patient_id', 'Paciente') !!}
                            <br>
                            {!! Form::select('patient', $patients, ['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
