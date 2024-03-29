@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Crear usuario</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='admin')
                            {!! Form::open(['route' => 'userStore','method'=> 'post']) !!}
                        @else
                            {!! Form::open(['route' => 'userStoreT','method'=> 'post']) !!}
                        @endif

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus maxlength="255">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" maxlength="255">

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra">

                                @error('dni')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="miemail@dominio.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="userType" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de usuario') }}</label>

                            <div class="col-md-6">
                                <input type="radio" id="student" name="userType" value="student" class="@error('userType') is-invalid @enderror" name="userType" {{ (old('userType')=='student')? "checked" : "" }} required autocomplete="userType" autofocus>
                                <label for="student">Alumno</label><br>

                                @if(Auth::user()->userType =='admin')
                                    <input type="radio" id="teacher" name="userType" value="teacher" class="@error('userType') is-invalid @enderror" name="userType" {{ (old('userType')=='teacher')? "checked" : "" }} required autocomplete="userType" autofocus>
                                    <label for="teacher">Profesor</label><br>
                                    <input type="radio" id="admin" name="userType" value="admin" class="@error('userType') is-invalid @enderror" name="userType" {{ (old('userType')=='admin')? "checked" : "" }} required autocomplete="userType" autofocus>
                                    <label for="admin">Administrador</label><br>
                                @endif

                                @error('userType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  value="{{ old('password')}}" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required value="{{ old('password-confirm')}}" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit('Registrar',['class'=>'btn-primary btn button-align']) !!}
                                {!! Form::close() !!}

                                @if(\Illuminate\Support\Facades\Auth::user()->userType=='admin')
                                    {!! Form::open(['route' => ['userIndex'], 'method' => 'get']) !!}
                                    {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                                    {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
