@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Brackets</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        <div class="row align-items-start">
                            <div class="col-2">
                                {!! Form::open(['route' => 'brakets.create', 'method' => 'get']) !!}
                                {!!   Form::submit('Crear tipo de Braket', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-10">
                                {!! Form::open(['route' => ['brakets.index'], 'method' => 'get']) !!}
                                {!! Form::text('query_brac',$query_brac,['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block; float:right;
                                margin-left: 25px;','placeholder'=>'Nombre, apellido o DNI', 'maxlength'=>"255"]) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary button-align-right ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary button-align-right','name'=>'semibutton'])!!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($brakets as $braket)
                                <tr style="word-break: break-word;">
                                    <td>{{ $braket->name }}</td>

                                <td>
                                    {!! Form::open(['route' => ['brakets.edit',$braket->id], 'method' => 'get','style'=>'display: inline']) !!}
                                    {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                    {!! Form::close() !!}
                                    {!! Form::open(['route' => ['brakets.destroy',$braket->id], 'method' => 'delete','style'=>'display: inline']) !!}
                                    {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                    {!! Form::close() !!}
                                </td>
                                </tr>
                            @endforeach
                        </table>
                        {{$brakets->render()}}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
