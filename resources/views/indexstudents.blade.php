@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h5>Estudiantes</h5></div>

                <div class="panel-body">
                    @include('flash::message')
                    <div class="form-group" >
                        {!! Form::model(\Illuminate\Support\Facades\Request::all(),['route' => ['indexstudents'], 'method' => 'get']) !!}
                        {!! Form::text('query_students',$query_students, ['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block; float:right;
                                margin-left: 25px;','placeholder'=>'Nombre, apellido o DNI', 'maxlength'=>"255"]) !!}
                        {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary button-align-right', 'name'=>'semibutton'])!!}
                        {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary button-align-right','name'=>'semibutton'])!!}
                        {!! Form::close() !!}
                    </div>
                    <br><br>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>DNI</th>
                            <th colspan="2">Acciones</th>
                        </tr>

                        @foreach ($mystudents as $mystudent)
                            <tr>
                                <td>{{ $mystudent->name }}</td>
                                <td>{{ $mystudent->surname }}</td>
                                <td>{{ $mystudent->email }}</td>
                                <td>{{ $mystudent->dni }}</td>
                                <td>
                                    {!! Form::open(['route' => ['destroyasociacion',$mystudent->id], 'method' => 'GET']) !!}
                                    {!!   Form::submit('Eliminar asignación', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->surname }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->dni }}</td>

                                <td>
                                    {!! Form::open(['route' => ['asignaralumno',$student->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Asignar', ['class'=> 'btn btn-primary'])!!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                    {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endsection
