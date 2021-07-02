@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Tratamientos</h5></div>

                    <div class="panel-body">
                        @include('flash::message')

                        <div class="row align-items-start">
                            <div class="col-2">
                                {!! Form::open(['route' => 'tipo_tratamientos.create', 'method' => 'get']) !!}
                                {!!   Form::submit('Crear tratamiento', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-10">
                                {!! Form::open(['route' => ['tipo_tratamientos.index'], 'method' => 'get','style'=>'text-align:right']) !!}
                                {!! Form::text('query_tipo_trat',$query_tipo_trat,['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block;
                                margin-left: 25px;','placeholder'=>'Nombre, apellido o DNI', 'maxlength'=>"50"]) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary','name'=>'semibutton'])!!}
                                {!! Form::close() !!}
                            </div>
                        </div>

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
                                    {!! Form::open(['route' => ['tipo_tratamientos.edit',$tipo_tratamiento->id], 'method' => 'get','style'=>'display: inline']) !!}
                                    {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                    {!! Form::close() !!}
                                    {!! Form::open(['route' => ['tipo_tratamientos.destroy',$tipo_tratamiento->id], 'method' => 'delete','style'=>'display: inline']) !!}
                                    {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                    {!! Form::close() !!}
                                </td>
                                </tr>
                            @endforeach
                        </table>
                        {{$tipo_tratamientos->links()}}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
