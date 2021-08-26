@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Crear paciente</h5></div>

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
                        {!! Form::open(['route' => 'storeteacher']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre: *') !!}
                            {!! Form::text('name',null,['class'=>'form-control', 'required','autofocus', 'maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('surname', 'Apellidos: *') !!}
                            {!! Form::text('surname',null,['class'=>'form-control', 'required','maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            <label for="email" >{{ __('Correo electrónico: *') }}</label>

                            <input id="email" type="email" placeholder="miemail@dominio.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="dni" >{{ __('DNI: *') }}</label>

                            <input id="dni" type="text" name="dni"  class="form-control" value="{{ old('dni') }}" required autocomplete="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra">

                        </div>
                        <div class="form-group">
                            {!! Form::label('telefono', 'Télefono: ') !!}
                            <input id="telefono" type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" required autocomplete="telefono" pattern="[0-9]{9}" title="Debe introducir 9 números">
                        </div>
                        <div class="form-group">
                            {!! Form::label('fechaNacimiento', 'Fecha de nacimiento: *') !!}
                            {!! Form::date('fechaNacimiento',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('riesgoASA' , 'Riesgo ASA: *') !!}
                            {!! Form::select('riesgoASA', array('I' => 'I', 'II' => 'II','III'=>'III'),'I',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('observaciones', 'Observaciones: ') !!}
                            {!! Form::text('observaciones',null,['class'=>'form-control', 'maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('child' , 'Infantil: *') !!}
                            {!! Form::select('child', array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        <br>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['indexteacher'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>(*): Campos obligatorios</p>

            </div>
        </div>
    </div>
@endsection
