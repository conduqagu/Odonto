@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar datos de {{\App\Patient::find($patient->id)->name}} {{\App\Patient::find($patient->id)->surname}}</h5></div>

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
                        {!! Form::model($patient, [ 'route' => ['updateteacher',$patient->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre: *') !!}
                            {!! Form::text('name',$patient->name,['class'=>'form-control', 'required','autofocus', 'maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('surname', 'Apellidos: *') !!}
                            {!! Form::text('surname',$patient->surname,['class'=>'form-control', 'required', 'maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            <label for="email" >{{ __('Correo electrónico: *') }}</label>
                            @if(old('email')==null)
                                <input id="email" type="email" placeholder="miemail@dominio.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$patient->email}}" required autocomplete="email">
                            @else
                                <input id="email" type="email" placeholder="miemail@dominio.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required autocomplete="email">
                            @endif


                        </div>
                        <div class="form-group">
                            <label for="dni" >{{ __('DNI: *') }}</label>
                            @if(old('dni')==null)
                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $patient->dni }}" required autocomplete="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra">
                            @else
                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni')}}" required autocomplete="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra">
                            @endif

                        </div>
                        <div class="form-group">
                            {!! Form::label('telefono', 'Teléfono: ') !!}
                            @if(old('telefono')==null)
                                <input id="telefono" type="text" name="telefono" class="form-control" value="{{ $patient->telefono}}"  autocomplete="telefono" pattern="[0-9]{9}" title="Debe introducir 9 números">
                            @else
                                <input id="telefono" type="text" name="telefono" class="form-control" value="{{ old('telefono')}}"  autocomplete="telefono" pattern="[0-9]{9}" title="Debe introducir 9 números">
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('fechaNacimiento', 'Fecha de nacimiento: *') !!}
                            {!! Form::date('fechaNacimiento',$patient->fechaNacimiento,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('riesgoASA' , 'Riesgo ASA: *') !!}
                            {!! Form::select('riesgoASA', array('I' => 'I', 'II' => 'II','III'=>'III'),$patient->riesgoASA,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('observaciones', 'Observaciones: ') !!}
                            {!! Form::text('observaciones',$patient->observaciones,['class'=>'form-control', 'maxlength'=>"191"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('child' , 'Infantil: *') !!}
                            {!! Form::select('child', array('1'=>'Si','0'=>'No'),$patient->child,['class' => 'form-control', 'required']) !!}
                        </div>
                        <br>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['patient.show',$patient->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>(*): Campos obligatorios</p>
            </div>
        </div>
    </div>
@endsection
