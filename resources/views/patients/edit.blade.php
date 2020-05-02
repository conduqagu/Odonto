@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar paciente</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($patient, [ 'route' => ['patients.update',$patient->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',$patient->name,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('surname', 'Apellidos') !!}
                            {!! Form::text('surname',$patient->surname,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('dni', 'DNI') !!}
                            {!! Form::text('dni',$patient->dni,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'E-mail') !!}
                            {!! Form::text('email',$patient->email,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('telefono', 'Télefono') !!}
                            {!! Form::text('telefono',$patient->telefono,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fechaNacimiento', 'Fecha de nacimiento') !!}
                            {!! Form::date('fechaNacimiento',$patient->fechaNacimiento,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('riesgoASA' , 'Riesgo ASA') !!}
                            {!! Form::select('riesgoASA', array('I' => 'I', 'II' => 'II','III'=>'III'), $patient->riesgoASA) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('observaciones', 'Observaciones') !!}
                            {!! Form::text('observaciones',$patient->observaciones,['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('child' , 'Infantil') !!}
                            {!! Form::select('child', array('1'=>'Si','0'=>'No'),$patient->child,['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
