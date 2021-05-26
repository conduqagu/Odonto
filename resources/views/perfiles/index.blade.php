@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => ['userCreate'], 'method' => 'get']) !!}
                        {!!   Form::submit('Crear nuevo usuario', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Correo electrónico</th>
                                <th>Tipo de Usuario</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->surname }}</td>
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
                                        <!--TODO: Edit user-->
                                        {!! Form::open(['route' => ['user.edit',$user->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                        <!--TODO: crear eliminar-->
                                        <br>
                                        {!! Form::open(['route' => ['user.destroy',$user->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}

                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
