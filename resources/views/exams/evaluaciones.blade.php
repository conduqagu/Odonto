@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pacientes </div>

                    <div class="panel-body">
                        @include('flash::message')

                        @foreach($evaluaciones as $evaluacion)
                            <div class="card">
                                <div class="card-header">{!!Form::label('fecha', $evaluacion->date) !!}</div>

                                <div class="card-body">
                                    <div>
                                        {!!  Form::label('previsto' , 'Previsto: '.$evaluacion->previsto) !!}
                                        <br>
                                        {!!  Form::label('maxilar' , 'Maxilar: '.$evaluacion->maxilar) !!}
                                        <br>
                                        {!!  Form::label('mandibular' , 'Mandibular: '.$evaluacion->mandibular) !!}
                                        <br>
                                        {!!  Form::label('logrado' , 'Logrado: '.$evaluacion->logrado) !!}
                                        <br>
                                        {!!  Form::label('otros' , 'Otros: '.$evaluacion->otros) !!}
                                    </div>
                                </div>
                            </div>
                            <br>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
