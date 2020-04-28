@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar diente</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::model($diente, [ 'route' => ['dientes.update',$diente->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre común del diente') !!}
                            {!! Form::text('name',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('number', 'Número del diente') !!}
                            {!! Form::text('number',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cuadrante', 'Número del diente') !!}
                            {!! Form::text('cuadrante',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sextante', 'Número del diente') !!}
                            {!! Form::text('sextante',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ausente', 'Ausente') !!}
                            {!! Form::select('ausente',array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
