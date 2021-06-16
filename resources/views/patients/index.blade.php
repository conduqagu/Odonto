@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Pacientes</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        <div class="form-group" >

                                {!! Form::model(\Illuminate\Support\Facades\Request::all(),['route' => ['patients.index'], 'method' => 'get']) !!}
                                {!! Form::text('query',null,['class'=>'col-md-3 form-control', 'autofocus', 'placeholder'=>'Nombre, apellido o DNI','style'=>'display:inline-block']) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary ','name'=>'semibutton'])!!}
                                {!! Form::close() !!}

                        </div>

                        {!! Form::open(['route' => 'patients.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear paciente', ['class'=> 'btn btn-primary button-align'])!!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
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

                                @if($patient->child==1)
                                        <td>Si</td>
                                    @else
                                        <td>No</td>
                                    @endif

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
                                        {!! Form::open(['route' => ['patients.edit',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
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
