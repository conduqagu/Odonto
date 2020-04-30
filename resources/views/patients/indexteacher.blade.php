@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pacientes </div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'createteacher', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear paciente', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Correo electrónico</th>
                                <th>Teléfono</th>
                                <th>Fecha de nacimiento</th>
                                <th>Riesgo ASA</th>
                                <th>Observaciones</th>
                                <th>Alumno</th>
                                <th colspan="4">Acciones</th>
                            </tr>

                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->surname }}</td>
                                    <td>{{ $patient->dni }}</td>
                                    <td>{{ $patient->email }}</td>
                                    <td>{{ $patient->telefono }}</td>
                                    <td>{{ $patient->fechaNacimiento }}</td>
                                    <td>{{ $patient->riesgoASA }}</td>
                                    <td>{{ $patient->observaciones }}</td>
                                    <td>
                                     @foreach ($patient->asociacionPatientStudents as $asociacionPatientStudent)
                                     {{$asociacionPatientStudent->student->name.", " }}
                                    @endforeach
                                    </td>

                                    <td>
                                        {!! Form::open(['route' => ['dientesPatient',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Dientes', ['class'=> 'btn btn-outline-dark'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['añadirAlumno',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Añadir Alumno', ['class'=> 'btn btn-outline-primary'])!!}
                                        {!! Form::close() !!}
                                        <br>
                                        {!! Form::open(['route' => ['destroyStudent',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Eliminar alumno', ['class'=> 'btn btn-outline-danger' ])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['editteacher',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    <br>
                                        {!! Form::open(['route' => ['patientdestroy',$patient->id], 'method' => 'delete']) !!}
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
