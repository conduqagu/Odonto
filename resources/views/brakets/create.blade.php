@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Crear Tipo de Bracket</h5></div>

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
                        {!! Form::open(['route' => 'brakets.store']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre: *') !!}
                            {!! Form::text('name',null,['class'=>'form-control', 'required','autofocus','maxlength'=>"191"]) !!}
                        </div>
                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['brakets.index'], 'method' => 'get']) !!}
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
