@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Mi perfil</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($user, [ 'route' => ['updateperfiladmin',$user->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',$user->name,['class'=>'form-control', 'required', 'maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('surname' , 'Apellidos') !!}
                            {!! Form::text('surname', $user->surname,['class' => 'form-control', 'required', 'maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            <label for="email" >{{ __('Correo electrónico') }}</label>

                            <input id="email" type="email" placeholder="miemail@dominio.com" class="form-control @error('email') is-invalid @enderror" name="email" value={{$user->email}} required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="dni" >{{ __('DNI') }}</label>

                            <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $user->dni }}" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra" required autocomplete="dni">

                            @error('dni')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}

                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
