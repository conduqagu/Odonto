@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Tratamientos</h5></div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'tipo_tratamientos.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Crear tratamiento', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Coste (€)</th>
                                <th>IVA (%)</th>


                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($tipo_tratamientos as $tipo_tratamiento)
                                <tr style="word-break: break-word;">
                                    <td>{{ $tipo_tratamiento->name }}</td>
                                    <td>{{ $tipo_tratamiento->coste }}</td>
                                    <td>{{ $tipo_tratamiento->iva }}</td>

                                    <td>
                                    {!! Form::open(['route' => ['tipo_tratamientos.edit',$tipo_tratamiento->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['tipo_tratamientos.destroy',$tipo_tratamiento->id], 'method' => 'delete']) !!}
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
