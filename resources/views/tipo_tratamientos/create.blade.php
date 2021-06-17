@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Crear tipo de tratamiento</h5></div>

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
                        {!! Form::open(['route' => 'tipo_tratamientos.store']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',null,['class'=>'form-control', 'required','autofocus', 'maxlength'=>"255"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('coste', 'Coste (€)') !!}
                            {!! Form::number('coste',0,['class'=>'form-control', 'required','step'=>'0.01','min'=>'0']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('iva', 'IVA (%)') !!}
                            {!! Form::number('iva',0,['class'=>'form-control', 'required','autofocus','step'=>'0.01', 'min'=>'0']) !!}
                        </div>

                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['tipo_tratamientos.index'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
