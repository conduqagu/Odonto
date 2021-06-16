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
                                @if(old('email')==null)
                                    <input id="name" type="text"  value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus maxlength="255">
                                @else
                                    <input id="name" type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus maxlength="255">
                                @endif

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
                                @if(old('email')==null)
                                    <input id="surname" type="text" value="{{$user->surname}}" class="form-control @error('surname') is-invalid @enderror" name="surname" required autocomplete="surname" maxlength="255">
                                @else
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" maxlength="255">
                                @endif

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
                                @if(old('email')==null)
                                    <input id="dni" type="text" value="{{$user->dni}}" class="form-control @error('dni') is-invalid @enderror" name="dni"  required autocomplete="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra">

                                @else
                                    <input id="dni" type="text" value="{{ old('dni') }}" class="form-control @error('dni') is-invalid @enderror" name="dni"  required autocomplete="dni" pattern="[0-9]{8}[A-Za-z]{1}" title="Debe introducir 8 números y una letra">

                                @endif

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
                                @if(old('email')==null)
                                    <input id="email" type="email" value="{{ $user->email }}"  class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                                @else
                                    <input id="email" type="email" value="{{ old('email') }}"  class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                                @endif
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

                                    <input type="radio" id="student" name="userType" value="student" class="@error('userType') is-invalid @enderror" name="userType" {{ (old('userType')!=null && old('userType')=='student')? "checked" : "" }} {{ (old('userType')==null && $user->userType=='student')? "checked" : "" }} required autocomplete="userType" autofocus>
                                    <label for="student">Alumno</label><br>

                                    <input type="radio" id="teacher" name="userType" value="teacher" class="@error('userType') is-invalid @enderror" name="userType"  {{ (old('userType')!=null && old('userType')=='teacher')? "checked" : "" }} {{ (old('userType')==null && $user->userType=='teacher')? "checked" : "" }}  required autocomplete="userType" autofocus>
                                    <label for="teacher">Profesor</label><br>

                                    <input type="radio" id="admin" name="userType" value="admin" class="@error('userType') is-invalid @enderror" name="userType"  {{ (old('userType')!=null && old('userType')=='admin')? "checked" : "" }} {{ (old('userType')==null && $user->userType=='admin')? "checked" : "" }} required autocomplete="userType" autofocus>
                                    <label for="admin">Administrador</label><br>

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
