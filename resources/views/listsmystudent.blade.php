@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h5>Mis alumnos</h5></div>
                <br>
                <div class="panel-body">
                    @include('flash::message')

                    {!! Form::open(['route' => ['listsmystudent'], 'method' => 'get']) !!}
                    {!! Form::text('query',null,['class'=>'col-md-3', 'autofocus', 'placeholder'=>'Nombre del alumno']) !!}
                    {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary'])!!}
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
                                {!! Form::open(['route' => ['destroyasociacion',$student->id], 'method' => 'GET']) !!}
                                {!!   Form::submit('Eliminar asignación', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach

                    </table>
                    <td>
                        {!! Form::open(['route' => 'indexstudents', 'method' => 'get']) !!}
                        {!!   Form::submit('Todos los alumnos', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </td>
                </div>
            </div>
        </div>
    </div>
    @endsection
