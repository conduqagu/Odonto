@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar diente</h5></div>

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
                        {!! Form::model($diente, [ 'route' => ['dientes.update',$diente->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre común del diente: *') !!}
                            {!! Form::text('name',$diente->name,['class'=>'form-control', 'required', 'autofocus','maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('number', 'Número del diente: *') !!}
                            {!! Form::text('number',$diente->number,['class'=>'form-control', 'required','maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cuadrante', 'Cuadrante: *') !!}
                            {!! Form::number('cuadrante',$diente->cuadrante,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sextante', 'Sextante: *') !!}
                            {!! Form::number('sextante',$diente->sextante,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ausente', 'Ausente: *') !!}
                            {!! Form::select('ausente',array('1'=>'Si','0'=>'No'),$diente->ausente,['class' => 'form-control', 'required']) !!}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='student')
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin del profesor: *') !!}
                            <input id="pin" type="password" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin') }}"  name="pin" required>
                            @error('pin')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        @endif
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['dientesPatient',$diente->patient_id], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>(*): Campos obligatorios</p>
            </div>
        </div>
    </div>
@endsection
