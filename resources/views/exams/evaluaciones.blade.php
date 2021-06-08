@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Evaluaciones</h5></div>
                    <br>
                    @if(count($evaluaciones)==0)
                        <div class="card">
                            <div class="card-header">No nay ninguna evaluación registrada</div>
                        </div>
                    @endif
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

                        <a class="btn btn-outline-dark button-align-right " style="margin-bottom: 15px" href="{{ url()->previous() }}">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endsection
