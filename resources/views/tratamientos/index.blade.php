@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'tratamientos.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear tratamiento', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Coste</th>
                                <th>Iva</th>
                                <th>Cobrado</th>
                                <th>Terapia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Brakets</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($tratamientos as $tratamiento)
                                <tr>
                                    <td>{{ $tratamiento->tipoTratamiento->name }}</td>
                                    <td>{{ $tratamiento->coste }}</td>
                                    <td>{{ $tratamiento->iva }}</td>
                                    <td>{{ $tratamiento->cobrado }}</td>
                                    <td>{{ $tratamiento->terapia }}</td>
                                    <td>{{ $tratamiento->fecha_inicio }}</td>
                                    <td>{{ $tratamiento->fecha_fin }}</td>
                                    <td>{{ $tratamiento->braket->name}}</td>


                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
