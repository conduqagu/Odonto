@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Diagnóstico</h5></div>

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
                        {!! Form::open(['route' => 'diagnosticos.store']) !!}
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre: *') !!}
                            {!! Form::text('nombre',null,['class'=>'form-control', 'required','autofocus','maxlength'=>"100"]) !!}
                        </div>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['diagnosticos.index'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>(*): Campos obligatorios</p>
            </div>
        </div>

    </div>
    </div>
@endsection
