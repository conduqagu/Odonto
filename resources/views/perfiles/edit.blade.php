@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-header"><h5>Editar usuario</h5></div>

                    <div class="card-body">
                        @include('flash::message')
                        {!! Form::model($user, [ 'route' => ['user.update',$user->id], 'method'=>'PUT']) !!}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"  value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus maxlength="255">

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
                                <input id="surname" type="text" value="{{$user->surname}}" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" maxlength="255">

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
                                <input id="dni" type="text" value="{{$user->dni}}" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra">

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
                                <input id="email" type="email" value="{{$user->email}}" placeholder="miemail@dominio.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                @if($user->userType=='student')
                                    <input type="radio" id="student" name="userType" value="student" class="@error('userType') is-invalid @enderror" name="userType" value="{{ old('userType') }}" required autocomplete="userType" autofocus checked>
                                    <label for="student">Alumno</label><br>
                                @else
                                    <input type="radio" id="student" name="userType" value="student" class="@error('userType') is-invalid @enderror" name="userType" value="{{ old('userType') }}" required autocomplete="userType" autofocus>
                                    <label for="student">Alumno</label><br>
                                @endif
                                @if($user->userType=='teacher')
                                    <input type="radio" id="teacher" name="userType" value="teacher" class="@error('userType') is-invalid @enderror" name="userType" value="{{ old('userType') }}" required autocomplete="userType" autofocus checked>
                                    <label for="teacher">Profesor</label><br>
                                @else
                                    <input type="radio" id="teacher" name="userType" value="teacher" class="@error('userType') is-invalid @enderror" name="userType" value="{{ old('userType') }}" required autocomplete="userType" autofocus>
                                    <label for="teacher">Profesor</label><br>
                                @endif
                                @if($user->userType =='admin')
                                    <input type="radio" id="admin" name="userType" value="admin" class="@error('userType') is-invalid @enderror" name="userType" value="{{ old('userType') }}" required autocomplete="userType" autofocus checked>
                                    <label for="admin">Administrador</label><br>
                                @else
                                    <input type="radio" id="admin" name="userType" value="admin" class="@error('userType') is-invalid @enderror" name="userType" value="{{ old('userType') }}" required autocomplete="userType" autofocus>
                                    <label for="admin">Administrador</label><br>
                                @endif
                                @error('userType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
