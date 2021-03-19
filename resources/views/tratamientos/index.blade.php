@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dientes</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'tratamientos.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear tratamiento', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Realizado</th>
                                <th>Coste</th>
                                <th>Iva</th>
                                <th>Cobrado</th>
                                <th>Terapia</th>
                                <th>Duracion Estimada</th>
                                <th>Brakets</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($tratamientos as $tratamiento)
                                <tr>
                                    <td>{{ $tratamiento->nombre }}</td>
                                    <td>{{ $tratamiento->realizado }}</td>
                                    <td>{{ $tratamiento->coste }}</td>
                                    <td>{{ $tratamiento->iva }}</td>
                                    <td>{{ $tratamiento->cobrado }}</td>
                                    <td>{{ $tratamiento->terapia }}</td>
                                    <td>{{ $tratamiento->duracionEstimada }}</td>
                                    <td>{{ $tratamiento->braket_id}}</td>


                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
