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

                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($patients as $patient)
                                <tr style="word-break: break-word;">
                                    <td  style="max-width: 78px;">{{ $patient->name }}</td>
                                    <td  style="max-width: 78px;">{{ $patient->surname }}</td>
                                    <td>{{ $patient->dni }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['patients.show',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-primary'])!!}
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
