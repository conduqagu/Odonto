@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Mis alumnos</div>
                <div class="panel-body">
                    @include('flash::message')
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
                        <td>
                            {!! Form::open(['route' => 'indexstudents', 'method' => 'get']) !!}
                            {!!   Form::submit('Todos los alumnos', ['class'=> 'btn btn-warning'])!!}
                            {!! Form::close() !!}
                        </td>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
