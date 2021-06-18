@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Usuarios</h5></div>

                    <div class="panel-body">
                        @include('flash::message')

                        <div class="row align-items-start">
                            <div class="col-2">
                                {!! Form::open(['route' => ['userCreate'], 'method' => 'get']) !!}
                                {!!   Form::submit('Crear nuevo usuario', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-10">
                                {!! Form::open(['route' => ['userIndex'], 'method' => 'get']) !!}
                                {!! Form::text('query_user',$query_user,['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block; float:right;
                                margin-left: 25px;','placeholder'=>'Nombre, apellido o DNI', 'maxlength'=>"255"]) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary button-align-right ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary button-align-right','name'=>'semibutton'])!!}
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
                                <th colspan="2">Acciones</th>
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

                                        <td>
                                            @if($user->userType=='teacher')
                                                {!! Form::open(['route' => ['indexstudents',$user->id], 'method' => 'get','style'=>'display: inline']) !!}
                                                {!!   Form::submit('Alumnos', ['class'=> 'btn btn-primary'])!!}
                                                {!! Form::close() !!}
                                            @endif
                                            {!! Form::open(['route' => ['user.edit',$user->id], 'method' => 'get','style'=>'display: inline']) !!}
                                            {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                            {!! Form::close() !!}

                                            {!! Form::open(['route' => ['user.destroy',$user->id], 'method' => 'delete','style'=>'display: inline']) !!}
                                            {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                            {!! Form::close() !!}
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
