@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear tratamiento</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'tratamientos.store']) !!}
                        <div class="form-group">
                            {!!  Form::label('tipo_tratamiento_id' , 'Nombre') !!}
                            {!! Form::select('tipo_tratamiento_id', $tipo_tratamientos,null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('realizado', 'Realizado') !!}
                            {!! Form::select('realizado', array('1'=>'Si','0'=>'No'),'0',['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('coste', 'Coste') !!}
                            {!! Form::number('coste',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('iva', 'Iva') !!}
                            {!! Form::number('iva','0',['class'=>'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cobrado', 'Cobrado') !!}
                            {!! Form::select('cobrado',array('1'=>'Si','0'=>'No'),'0',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('terapia' , 'Terapia') !!}
                            {!! Form::select('terapia', array('sin definir'=>'Sin definir','convencional'=>'Convencional','fases'=>'Fases'),'sin definir',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('duracionEstimada', 'Duracion Estimada') !!}
                            {!! Form::text('duracionEstimada',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('braket_id' , 'Brakets') !!}
                            {!! Form::select('braket_id', $brakets,null,['class' => 'form-control']) !!}
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
