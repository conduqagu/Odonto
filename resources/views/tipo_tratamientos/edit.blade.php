@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar tipo de tratamiento</div>

                    <div class="card-body">
                        @include('flash::message')
                        {!! Form::model($tipo_tratamiento, ['route' => ['tipo_tratamientos.update',$tipo_tratamiento->id], 'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',$tipo_tratamiento->name,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>

                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection