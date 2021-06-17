@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Examen inicial</h5></div>

                <div class="card-body">
                    @include('flash::message')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherInicial',$exam->id],'method'=>'PUT']) !!}
                    <div class="form-group">
                        {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name) !!}
                        <br>
                    </div>
                    <div>
                        {!! Form::label('date', 'Fecha: '.$exam->date) !!}
                    </div>
                    <div>
                        {!!  Form::label('aspectoExtraoralNormal' , 'Aspecto Extraoral Normal: *') !!}
                        {!! Form::select('aspectoExtraoralNormal', array('1'=>'Si','0'=>'No'),'1',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('cancerOral' , 'Cancer Oral: *') !!}
                        {!! Form::select('cancerOral', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('anomaliasLabios' , 'Anomalias en labios: *') !!}
                        {!! Form::select('anomaliasLabios', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('patologiaMucosa' , 'Patologías en mucosas: *') !!}
                        {!! Form::select('patologiaMucosa', array('Ninguna'=>'Ninguna','Tumor maligno'=>'Tumor maligno','leucoplasia'=>'Leucoplasia','Liquen plano'=>'Liquen plano'),'Ninguna',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('fluorosis' , 'Fluorosis: *') !!}
                        {!! Form::select('fluorosis', array('Normal'=>'Normal','Discutible'=>'Discutible','Muy ligera'=>'Muy ligera','Ligera'=>'Ligera','Moderada'=>'Moderada','Intensa'=>'Intensa','Excluida'=>'Excluida','No registrada'=>'No registrada'),'Normal',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('estadoS1' , 'Estado primer sextante: *') !!}
                        {!! Form::select('estadoS1', array('sano'=>'Sano','hemorragia'=>'Hemorragia','tártaro'=>'Tártaro','bolsa 4-5 mm'=>'Bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'Excluido'),'sano',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('estadoS2' , 'Estado segundo sextante: *') !!}
                        {!! Form::select('estadoS2', array('sano'=>'Sano','hemorragia'=>'Hemorragia','tártaro'=>'Tártaro','bolsa 4-5 mm'=>'Bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'Excluido'),'sano',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('estadoS3' , 'Estado tercer sextante: *') !!}
                        {!! Form::select('estadoS3', array('sano'=>'Sano','hemorragia'=>'Hemorragia','tártaro'=>'Tártaro','bolsa 4-5 mm'=>'Bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'Excluido'),'sano',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('estadoS4' , 'Estado cuarto sextante: *') !!}
                        {!! Form::select('estadoS4', array('sano'=>'Sano','hemorragia'=>'Hemorragia','tártaro'=>'Tártaro','bolsa 4-5 mm'=>'Bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'Excluido'),'sano',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('estadoS5' , 'Estado quinto sextante: *') !!}
                        {!! Form::select('estadoS5', array('sano'=>'Sano','hemorragia'=>'Hemorragia','tártaro'=>'Tártaro','bolsa 4-5 mm'=>'Bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'Excluido'),'sano',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('estadoS6' , 'Estado sexto sextante: *') !!}
                        {!! Form::select('estadoS6', array('sano'=>'Sano','hemorragia'=>'Hemorragia','tártaro'=>'Tártaro','bolsa 4-5 mm'=>'Bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'Excluido'),'sano',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('claseAngle' , 'Angle: *') !!}
                        {!! Form::select('claseAngle', array('clase I'=>'clase I','clase II'=>'clase II','clase III'=>'clase III'),'clase I',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('lateralAngle' , 'Lateral Angle: *') !!}
                        {!! Form::select('lateralAngle', array('Unilateral'=>'Unilateral','Bilateral'=>'Bilateral'),'Unilateral',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('tipoDentición' , 'Tipo Dentición: *') !!}
                        {!! Form::select('tipoDentición', array('Temporal'=>'Temporal','Mixta'=>'Mixta'),'Temporal',['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!!  Form::label('apiñamientoIncisivoInferior' , 'Apiñamiento Incisivo Inferior: *') !!}
                        {!! Form::select('apiñamientoIncisivoInferior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('apiñamientoIncisivoSuperior' , 'Apiñamiento Incisivo Superior: *') !!}
                        {!! Form::select('apiñamientoIncisivoSuperior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('perdidaEspacioAnterior' , 'Perdida Espacio Anterior: *') !!}
                        {!! Form::select('perdidaEspacioAnterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('perdidaEspacioPosterior' , 'Perdida Espacio Posterior: *') !!}
                        {!! Form::select('perdidaEspacioPosterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('mordidaCruzadaAnterior' , 'Mordida Cruzada Anterior: *') !!}
                        {!! Form::select('mordidaCruzadaAnterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('mordidaCruzadaPosterior' , 'Mordida Cruzada Posterior: *') !!}
                        {!! Form::select('mordidaCruzadaPosterior', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('desviacionLineaMedia' , 'Desviacion Linea Media: *') !!}
                        {!! Form::select('desviacionLineaMedia', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('mordidaAbierta' , 'Mordida Abierta: *') !!}
                        {!! Form::select('mordidaAbierta', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                    </div>
                    <div>
                        {!!  Form::label('habitos' , 'Hábitos: *') !!}
                        {!! Form::select('habitos', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}

                    </div>
                    <div>
                        {!!  Form::label('otros' , 'Otros:') !!}
                        {!! Form::text('otros', null, ['class'=>'form-control','maxlength'=>"255"]) !!}
                        <br>
                    </div>
                    {!! Form::submit( 'Continuar examen dental', ['class' => 'btn btn-primary', 'name' => 'submitbutton', 'value' => 'save'])!!}
                    {!! Form::submit( 'Guardar',['class' => 'btn btn-primary', 'name' => 'submitbutton', 'value' => 'finish'])!!}

                    {!! Form::close() !!}

                </div>
            </div>
            <p>(*): Campos obligatorios</p>
        </div>
    </div>
</div>
@endsection
