@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'tratamientos.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear tratamiento', ['class'=> 'btn btn-primary button-align'])!!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Coste (€)</th>
                                <th>IVA (%)</th>
                                <th>Terapia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Brackets</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($tratamientos as $tratamiento)
                                <tr style="word-break: break-word;">
                                    <td>{{ $tratamiento->tipoTratamiento->name }}</td>
                                    <td>{{$tratamiento->coste}}</td>
                                    <td>{{$tratamiento->iva}}</td>
                                    <td>{{ $tratamiento->terapia }}</td>
                                    <td>{{ $tratamiento->fecha_inicio }}</td>
                                    <td>{{ $tratamiento->fecha_fin }}</td>
                                    <td>{{ $tratamiento->braket->name}}</td>


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
