@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {!! Form::model($user, [ 'route' => ['updateperfilteacher',$user->id], 'method'=>'PUT']) !!}

                <div class="card">
                    <div class="card-header">Mi perfil</div>

                    <div class="card-body">
                        @include('flash::message')


                        <div class="form-group">
                            {!! Form::label('name', 'Nombre: ') !!}
                            {!! Form::label('name',$user->name) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('surname' , 'Apellidos: ') !!}
                            {!! Form::label('surname', $user->surname) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('dni' , 'DNI: ') !!}
                            {!! Form::label('dni',$user->dni) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('email' , 'Correo electrónico') !!}
                            {!! Form::text('email',$user->email,['class' => 'form-control', 'required']) !!}
                        </div>

                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            {!!  Form::label('oldpin' , 'PIN original: ') !!}
                            <input id="oldpin" type="password" class="form-control" name="oldpin" placeholder="Inicialmente es su DNI">
                        </div>
                        <div class="form-group">
                            {!!  Form::label('pin','Nuevo PIN:') !!}
                            <input id="pin" type="password" class="form-control" name="pin" placeholder="Introduzca un nuevo pin">
                        </div>
                        <div class="form-group">
                            {!!  Form::label('confirmpin','Corfirmar nuevo PIN:') !!}
                            <input id="confirmpin" type="password" class="form-control" name="confirmpin">
                        </div>
                    </div>
                </div>
                <br>

                {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
