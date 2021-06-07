@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear tipo de tratamiento</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'tipo_tratamientos.store']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',null,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('coste', 'Coste') !!}
                            {!! Form::number('coste',null,['class'=>'form-control', 'required','step'=>'0.01']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('iva', 'IVA') !!}
                            {!! Form::text('iva',0,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>

                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
