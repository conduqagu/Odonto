@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Diagnósticos</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row align-items-start">
                            <div class="col-2">
                                {!! Form::open(['route' => 'diagnosticos.create', 'method' => 'get']) !!}
                                {!!   Form::submit('Crear diagnostico', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-10">
                                {!! Form::open(['route' => ['diagnosticos.index'], 'method' => 'get','style'=>'text-align:right']) !!}
                                {!! Form::text('query_diag',$query_diag,['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block;
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
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($diagnosticos as $diagnostico)
                                <tr style="word-break: break-word;">
                                    <td>{{ $diagnostico->nombre }}</td>

                                    <td>
                                        {!! Form::open(['route' => ['diagnosticos.edit',$diagnostico->id], 'method' => 'get','style'=>'display: inline-block']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    {!! Form::open(['route' => ['diagnosticos.destroy',$diagnostico->id], 'method' => 'delete','style'=>'display: inline-block']) !!}
                                    {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                    {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{$diagnosticos->render()}}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
