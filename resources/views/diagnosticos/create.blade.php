@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Diagnóstico</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'diagnosticos.store']) !!}
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre',null,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('tipo_diagnostico_id', 'Tipo') !!}
                            <br>
                            {!! Form::select('tipo_diagnostico_id', $tipo_diagnosticos, null,['class' => 'form-control', 'required']) !!}
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