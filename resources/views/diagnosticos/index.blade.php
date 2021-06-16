@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Diagnósticos</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'diagnosticos.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear diagnostico', ['class'=> 'btn btn-primary button-align'])!!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                        <br>
                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($diagnosticos as $diagnostico)
                                <tr style="word-break: break-word;">
                                    <td>{{ $diagnostico->nombre }}</td>

                                    <td>
                                        {!! Form::open(['route' => ['diagnosticos.edit',$diagnostico->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                    {!! Form::open(['route' => ['diagnosticos.destroy',$diagnostico->id], 'method' => 'delete']) !!}
                                    {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
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
