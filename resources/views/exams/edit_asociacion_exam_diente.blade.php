@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="title m-b-md">
                <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                    <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                </a>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Examen dental</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($asociacion_exam_diente, ['route'=>['update_asociacionED',$asociacion_exam_diente],'method'=>'put']) !!}

                        <div class="form-group">
                            {!!Form::label('diente__id', 'Diente') !!}
                            <br>
                            {!! Form::select('diente_id', $dientes,$asociacion_exam_diente->diente_id, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('denticionRaiz' , 'Dentición raíz') !!}
                            {!! Form::select('denticionRaiz', array('Sano'=>'Sano','Cariado'=>'Cariado','Obturado sin caries'=>'Obturado sin caries',
                            'Pérdida otro motivo'=>'Pérdida otro motivo', 'Fisura Obturada'=>'Fisura Obturada','Pilar puente/corona'=>'Pilar puente/corona','Cariado'=>'Cariado',
                            'Diente no erupcionado'=>'Diente no erupcionado','Fractura'=>'Fractura'),$asociacion_exam_diente->denticionRaiz,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('denticionCorona' , 'Dentición Corona') !!}
                            {!! Form::select('denticionCorona', array('Sano'=>'Sano','Cariado'=>'Cariado','Obturado sin caries'=>'Obturado sin caries',
                            'Pérdida otro motivo'=>'Pérdida otro motivo', 'Fisura Obturada'=>'Fisura Obturada','Pilar puente/corona'=>'Pilar puente/corona','Cariado'=>'Cariado',
                            'Diente no erupcionado'=>'Diente no erupcionado','Fractura'=>'Fractura'),$asociacion_exam_diente->denticionCorona,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('tratamiento' , 'Tratamiento') !!}
                            {!! Form::select('tratamiento', array('Ninguno'=>'Ninguno','Preventivo'=>'Preventivo','Obturación de fisuras'=>'Obturación de fisuras',
                            'Obt. 1 o mas superficies'=>'Obt. 1 o mas superficies','Obt 2 o mas superficies'=>'Obt 2 o mas superficies','Corona'=>'Corona',
                            'Carilla estética'=>'Carilla estética','Tratamiento pulgar'=>'Tratamiento pulgar','Exodoncia'=>'Exodoncia',
                            'No registrado'=>'No registrado'),$asociacion_exam_diente->tratamiento,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('opacidad' , 'Opacidad') !!}
                            {!! Form::select('opacidad', array('Ningún estado anormal'=>'Ningún estado anormal','Opacidad delimitada'=>'Opacidad delimitada',
                            'OpacidadDifusa'=>'Opacidad Difusa','Hipoplasia'=>'Hipoplasia','Otros defectos'=>'Otros defectos',
                            'Opacidad elimitada y difusa'=>'Opacidad elimitada y difusa','Opacidad delimitada e hipoplasia'=>'Opacidad delimitada e hipoplasia',
                            'Opacidad difusa e hipoplasia'=>'Opacidad difusa e hipoplasia'),$asociacion_exam_diente->opacidad,['class' => 'form-control']) !!}
                        </div>

                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                        <br>
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin del profesor') !!}
                            <input id="pin" type="password" class="awesome" name="pin" required>
                        </div>
                        <td>
                            {!! Form::open(['route' => 'exams.index', 'method' => 'get']) !!}
                            {!!   Form::submit('Terminar', ['class'=> 'btn btn-warning'])!!}
                            {!! Form::close() !!}
                        </td>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
