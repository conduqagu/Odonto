@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Estudiantes</div>
                <br>
                <div class="panel-body">
                    @include('flash::message')
                    <div class="form-group" >
                        {!! Form::open(['route' => ['indexstudents'], 'method' => 'get']) !!}
                        {!! Form::text('query',null,['class'=>'col-md-4', 'autofocus', 'placeholder'=>'Nombre del alumno']) !!}
                        {!! Form::submit('Buscar', ['class'=> 'btn btn-success col-md-2'])!!}
                        {!! Form::close() !!}

                    </div>

                    {!! Form::open(['route' => 'listsmystudent', 'method' => 'get']) !!}
                    {!!   Form::submit('Mis alumnos', ['class'=> 'btn btn-primary'])!!}
                    {!! Form::close() !!}
                    <br>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>DNI</th>
                            <th colspan="2">Acciones</th>
                        </tr>

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
                </div>
            </div>
        </div>
    </div>
    @endsection
