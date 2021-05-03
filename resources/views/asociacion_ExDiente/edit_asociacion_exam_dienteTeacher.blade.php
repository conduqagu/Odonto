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

                        {!! Form::model($asociacion_exam_diente, ['route'=>['updateasociacionEDPeriodoncia',$asociacion_exam_diente],'method'=>'put']) !!}

                        <div class="form-group">
                            {!!Form::label('diente__id', 'Diente') !!}
                            <br>
                            {!! Form::select('diente_id', $dientes,$asociacion_exam_diente->diente_id, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!Form::label('furca', 'Furca') !!}
                            <br>
                            {!! Form::number('furca',$asociacion_exam_diente->furca, ['class' => 'form-control', 'required']) !!}</div>
                        <div>
                            {!!Form::label('retraccion', 'Retracción') !!}
                            <br>
                            {!! Form::number('retraccion',$asociacion_exam_diente->retraccion, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!Form::label('hipertrofia', 'hipertrofia') !!}
                            <br>
                            {!! Form::number('hipertrofia',$asociacion_exam_diente->hipertrofia, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!Form::label('sondaje', 'Sondaje') !!}
                            <br>
                            {!! Form::number('sondaje',$asociacion_exam_diente->sondaje, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!Form::label('movilidad', 'Movilidad') !!}
                            <br>
                            {!! Form::boolean('movilidad',$asociacion_exam_diente->movilidad, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!Form::label('sangrado', 'Sangrado') !!}
                            <br>
                            {!! Form::boolean('sangrado',$asociacion_exam_diente->sangrado, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!Form::label('encia_insertada', 'Encía insertada') !!}
                            <br>
                            {!! Form::boolean('encia_insertada',$asociacion_exam_diente->encia_insertada, ['class' => 'form-control', 'required']) !!}
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
