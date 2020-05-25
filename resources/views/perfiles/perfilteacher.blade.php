@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mi perfil</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($user, [ 'route' => ['updateperfilteacher',$user->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',$user->name,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('surname' , 'Apellidos') !!}
                            {!! Form::text('surname', $user->surname,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('email' , 'Correo electrónico') !!}
                            {!! Form::text('email',$user->email,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('dni' , 'DNI') !!}
                            {!! Form::text('dni',$user->dni,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('pin' , 'PIN original: ') !!}
                            <input id="pin" type="password" class="form-control" name="pin" placeholder="Dejar este campo en blanco en caso de no tener ningún pin previo">
                        </div>
                        <div class="form-group">
                            {!!  Form::label('newpin','Nuevo PIN:') !!}
                            <input id="newpin" type="password" class="form-control" name="newpin" required>
                        </div>
                        <div class="form-group">
                            {!!  Form::label('confirmpin','Corfirmar nuevo PIN:') !!}
                            <input id="confirmpin" type="password" class="form-control" name="confirmpin" required>
                        </div>
                        <br>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
