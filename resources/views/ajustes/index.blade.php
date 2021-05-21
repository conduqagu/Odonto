@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <br>
                    <div class="panel-body">
                        @include('flash::message')
                        <div class="card">
                        <div class="card-header">Ajustes</div>
                        <div class="card-body">
                            @if(Auth::user()->userType =='student')
                                {!! Form::open(['route' => 'perfilstudent', 'method' => 'get']) !!}
                                {!!   Form::submit('Mi perfil', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @elseif(Auth::user()->userType =='teacher')
                                {!! Form::open(['route' => 'perfilteacher', 'method' => 'get']) !!}
                                {!!   Form::submit('Mi perfil', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            <br>
                                {!! Form::open(['route' => 'userCreate', 'method' => 'get']) !!}
                                {!!   Form::submit('Nuevo Registro de Usuario', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @elseif(Auth::user()->userType =='admin')
                                {!! Form::open(['route' => 'perfiladmin', 'method' => 'get']) !!}
                                {!!   Form::submit('Mi perfil', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @endif
                            @if(Auth::user()->userType =='student'||Auth::user()->userType =='teacher')
                                <br>
                                {!! Form::open(['route' => 'tipo_tratamientos.index', 'method' => 'get']) !!}
                                {!!   Form::submit('Tipo de tratamientos', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                                <br>
                                {!! Form::open(['route' => 'diagnosticos.index', 'method' => 'get']) !!}
                                {!!   Form::submit('Diagnosticos', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                                <br>
                                {!! Form::open(['route' => 'brakets.index', 'method' => 'get']) !!}
                                {!!   Form::submit('Brakets', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
