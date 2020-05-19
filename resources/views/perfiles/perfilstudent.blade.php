@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mi perfil</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($user, [ 'route' => ['updateperfilstudent',$user->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',$user->name,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('surname' , 'Apellidos') !!}
                            {!! Form::text('surname', $user->surname,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('email' , 'Correo electrónico') !!}
                            {!! Form::text('email',$user->email,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('dni' , 'DNI') !!}
                            {!! Form::text('dni',$user->dni,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            <br>
                            {!! Form::label('Mis profesores supervisores') !!}
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>

                                </tr>

                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $teacher->name }}</td>
                                        <td>{{ $teacher->surname }}</td>
                                        <td>{{ $teacher->email }}</td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
