@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pacientes</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'patients.create', 'method' => 'get']) !!}
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
                                <th>Infantil</th>
                                <th colspan="2">Acciones</th>
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
                                    @if($patient->child==1)
                                        <td>Si</td>
                                    @else
                                        <td>No</td>
                                    @endif

                                    <td>
                                        {!! Form::open(['route' => ['dientesPatient',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Dientes', ['class'=> 'btn btn-outline-dark'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                    <td>
                                        {!! Form::open(['route' => ['patients.edit',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
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
