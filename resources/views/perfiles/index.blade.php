@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Usuarios</h5></div>

                    <div class="panel-body">
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
                        <div class="row align-items-start">
                            <div class="col-2">
                                {!! Form::open(['route' => ['userCreate'], 'method' => 'get']) !!}
                                {!!   Form::submit('Crear nuevo usuario', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-10">
                                {!! Form::open(['route' => ['userIndex'], 'method' => 'get','style'=>'text-align:right']) !!}
                                {!! Form::text('query_user',$query_user,['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block;
                                margin-left: 25px;','placeholder'=>'Nombre, apellido o DNI', 'maxlength'=>"50"]) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary ','name'=>'semibutton'])!!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <br>



                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre y apellidos</th>
                                <th>DNI</th>
                                <th>Correo electrónico</th>
                                <th>Tipo de Usuario</th>
                                <th colspan="2" style="width: 260px">Acciones</th>
                            </tr>

                            @foreach ($users as $user)
                                <tr style="word-break: break-word;">
                                    <td>{{ $user->name.' '.$user->surname }}</td>
                                    <td>{{ $user->dni }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->userType=='student')
                                        <td>{{ 'Alumno/a' }}</td>
                                    @elseif($user->userType=='teacher')
                                        <td>{{ 'Profesor/a' }}</td>
                                    @else
                                        <td>{{ 'Administrador/a' }}</td>
                                    @endif

                                        <td style="width: 260px">

                                            {!! Form::open(['route' => ['user.edit',$user->id], 'method' => 'get','style'=>'display: inline']) !!}
                                            {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                            {!! Form::close() !!}

                                            {!! Form::open(['route' => ['user.destroy',$user->id], 'method' => 'delete','style'=>'display: inline']) !!}
                                            {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                            {!! Form::close() !!}

                                            @if($user->userType=='teacher')
                                                {!! Form::open(['route' => ['indexstudents',$user->id], 'method' => 'get','style'=>'display: inline']) !!}
                                                {!!   Form::submit('Alumnos', ['class'=> 'btn btn-primary'])!!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>

                                </tr>
                            @endforeach
                        </table>
                        {{$users->links()}}

                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
