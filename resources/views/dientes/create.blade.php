@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear diente</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'dientes.store']) !!}
                        <div class="form-group">
                            {!!Form::label('patient', 'Paciente: '.$patient->name.' '.$patient->surname) !!}
                            {!! Form::hidden('patient_id',$patient->id) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre común del diente') !!}
                            {!! Form::text('name',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('number', 'Número del diente') !!}
                            {!! Form::number('number',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cuadrante', 'Cuadrante') !!}
                            {!! Form::number('cuadrante',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sextante', 'Sextante') !!}
                            {!! Form::number('sextante',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ausente', 'Ausente') !!}
                            {!! Form::select('ausente',array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='student')
                            <div class="form-group">
                                {!! Form::label('pin', 'Pin del profesor') !!}
                                <input id="pin" type="password" class="form-control" name="pin" required>
                            </div>
                        @endif
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
