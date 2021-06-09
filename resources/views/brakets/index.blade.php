@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Brakets</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'brakets.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear tipo de Braket', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($brakets as $braket)
                                <tr>
                                    <td>{{ $braket->name }}</td>

                                <td>
                                    {!! Form::open(['route' => ['brakets.edit',$braket->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['brakets.destroy',$braket->id], 'method' => 'delete']) !!}
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
