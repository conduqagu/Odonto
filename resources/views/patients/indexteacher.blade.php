@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Pacientes</h5> </div>

                    <div class="panel-body">
                        @include('flash::message')
                        <div class="form-group" >
                            {!! Form::open(['route' => ['indexteacher'], 'method' => 'get']) !!}
                            {!! Form::text('query',null,['class'=>'col-md-3', 'autofocus', 'placeholder'=>'Nombre, apellido o DNI']) !!}
                            {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary'])!!}
                            {!! Form::close() !!}

                        </div>

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
                                <th>Alumnos</th>
                                <th colspan="4">Acciones</th>
                            </tr>

                            @foreach ($patients as $patient)
                                <tr style="word-break: break-word;">
                                    <td  style="max-width: 78px;">{{ $patient->name }}</td>
                                    <td  style="max-width: 78px;">{{ $patient->surname }}</td>
                                    <td>{{ $patient->dni }}</td>
                                    <td  style="max-width: 90px;">{{ $patient->email }}</td>
                                    <td>{{ $patient->telefono }}</td>
                                    @if($patient->child==1)
                                        <td>{{ $patient->fechaNacimiento." (Infantil)" }}</td>
                                    @else
                                        <td>{{ $patient->fechaNacimiento}}</td>
                                    @endif
                                    <td>{{ $patient->riesgoASA }}</td>
                                    <td style="max-width: 138px;">{{ $patient->observaciones }}</td>

                                    <td>
                                    @foreach ($patient->students as $student)
                                     {{$student->name." ".$student->surname.", " }}
                                    @endforeach
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['dientesPatient',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Dientes', ['class'=> 'btn btn-outline-dark'])!!}
                                        {!! Form::close() !!}
                                        <br>
                                        {!! Form::open(['route' => ['exams.index',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Exámenes', ['class'=> 'btn btn-outline-dark'])!!}
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
