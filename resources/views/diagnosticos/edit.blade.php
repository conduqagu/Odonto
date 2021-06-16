@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar diagnóstico</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($diagnostico, [ 'route' => ['diagnosticos.update',$diagnostico->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre',$diagnostico->nombre,['class'=>'form-control', 'required','autofocus','maxlength'=>"255"]) !!}
                        </div>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}

                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['diagnosticos.index'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
