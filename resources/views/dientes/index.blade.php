@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dientes</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'dientes.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear diente', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre Común</th>
                                <th>Número</th>
                                <th>Cuadrante</th>
                                <th>Sextante</th>
                                <th>Ausente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($dientes as $diente)
                                <tr>
                                    <td>{{ $diente->name }}</td>
                                    <td>{{ $diente->number }}</td>
                                    <td>{{ $diente->cuadrante }}</td>
                                    <td>{{$diente->ausente}}</td>
                                    <td>{{ $diente->sextante }}</td>

                                    <td>
                                        {!! Form::open(['route' => ['dientes.edit',$diente->id], 'method' => 'get']) !!}
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
