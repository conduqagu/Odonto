@extends('layouts.app')

@section('content')
     <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Pacientes</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group" >
                            <div class="row align-items-start">
                                <div class="col-2">
                                    {!! Form::open(['route' => 'patients.create', 'method' => 'get']) !!}
                                    {!!   Form::submit('Crear paciente', ['class'=> 'btn btn-primary button-align'])!!}
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-10">
                                {!! Form::open(['route' => ['patients.index'], 'method' => 'get','style'=>'text-align:right']) !!}
                                {!! Form::text('query_patient',$query_patient,['class'=>'col-md-3 form-control', 'autofocus', 'placeholder'=>'Nombre, apellido o DNI','style'=>'display:inline;  margin-left: 25px;']) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary ','name'=>'semibutton'])!!}
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>


                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre y Apellidos</th>
                                <th>DNI</th>

                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($patients as $patient)
                                <tr style="word-break: break-word;">
                                    <td  style="max-width: 78px;">{{ $patient->name.' '.$patient->surname }}</td>
                                    <td>{{ $patient->dni }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['patients.show',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-primary'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        {{$patients->render()}}

                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
