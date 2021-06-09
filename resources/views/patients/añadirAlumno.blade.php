@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Añadir alumno a paciente</h5></div>

                    <div class="card-body">

                        <div class="panel-body">
                            @include('flash::message')
                            <div class="form-group" >
                                <!--
                                {!! Form::open(['route' => ['añadirAlumno',$patient->id], 'method' => 'get']) !!}
                                {!! Form::text('query',null,['class'=>'col-md-4', 'autofocus', 'placeholder'=>'Nombre, apellido o DNI']) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success col-md-2'])!!}
                                {!! Form::close() !!}

                                    -->
                            </div>
                            {{Form::label('paciente','Paciente: '.$patient->name.' '.$patient->surname)}}

                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>DNI</th>
                                    <th colspan="4">Acciones</th>
                                </tr>

                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->surname }}</td>
                                        <td>{{ $student->dni }}</td>
                                        <td>
                                            {!! Form::open(['route' => ['storeAlumno',$student->id], 'method' => 'get']) !!}
                                            {!! Form::hidden('patient_id',$patient->id) !!}
                                            {!!   Form::submit('Añadir a este paciente', ['class'=> 'btn btn-primary' ])!!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {!! Form::open(['route' => ['indexteacher'], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                            {!! Form::close() !!}
                        </div>
                    </div>


            </div>
        </div>
    </div>
@endsection
