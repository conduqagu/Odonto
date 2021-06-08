@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar datos de {{\App\Patient::find($patient->id)->name}} {{\App\Patient::find($patient->id)->surname}}</h5></div>

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
                            {!! Form::text('telefono',$patient->telefono,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fechaNacimiento', 'Fecha de nacimiento') !!}
                            {!! Form::date('fechaNacimiento',$patient->fechaNacimiento,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('riesgoASA' , 'Riesgo ASA') !!}
                            {!! Form::select('riesgoASA', array('I' => 'I', 'II' => 'II','III'=>'III'),'I',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('observaciones', 'Observaciones') !!}
                            {!! Form::text('observaciones',$patient->observaciones,['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('child' , 'Infantil') !!}
                            {!! Form::select('child', array('1'=>'Si','0'=>'No'),$patient->child,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin del profesor') !!}
                            <input id="pin" type="password" class="form-control" name="pin" required>
                        </div>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        <a class="btn btn-outline-dark button-align-right " style="margin-bottom: 15px" href="{{ url()->previous() }}">
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
