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

                        {!! Form::model($asociacion_exam_diente, ['route'=>['update_asociacionEDPeriodoncia',$asociacion_exam_diente],'method'=>'put']) !!}

                        <div class="form-group">
                            {!!Form::label('diente__id', 'Diente: '.$asociacion_exam_diente->diente->id) !!}
                        </div>
                        <div>
                            {!!  Form::label('furca' , 'Furca') !!}
                            {!! Form::number('furca',$asociacion_exam_diente->furca,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('retraccion' , 'Retracción') !!}
                            {!! Form::number('retraccion',$asociacion_exam_diente->retraccion,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('hipertrofia' , 'Hipertrofia') !!}
                            {!! Form::number('hipertrofia',$asociacion_exam_diente->hipertrofia,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('sondaje' , 'Sondaje') !!}
                            {!! Form::select('sondaje', array('1'=>'Si','0'=>'No'), $asociacion_exam_diente->sondaje,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('movilidad' , 'Movilidad') !!}
                            {!! Form::select('movilidad', array('1'=>'Si','0'=>'No'),$asociacion_exam_diente->movilidad,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('sangrado' , 'Sangrado') !!}
                            {!! Form::select('sangrado',array('1'=>'Si','0'=>'No'), $asociacion_exam_diente->sangrado,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('encia_insertada' , 'Encia insertada') !!}
                            {!! Form::select('encia_insertada',array('1'=>'Si','0'=>'No'), $asociacion_exam_diente->encia_insertada,['class' => 'form-control']) !!}
                        </div>
                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
