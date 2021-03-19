@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dientes</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'tipo_tratamientos.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear tipo tratamiento', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>

                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($tipo_tratamientos as $tipo_tratamiento)
                                <tr>
                                    <td>{{ $tipo_tratamiento->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
