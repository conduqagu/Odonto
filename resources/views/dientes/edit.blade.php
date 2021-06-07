@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar diente</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($diente, [ 'route' => ['dientes.update',$diente->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre común del diente') !!}
                            {!! Form::text('name',$diente->name,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('number', 'Número del diente') !!}
                            {!! Form::text('number',$diente->number,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('cuadrante', 'Cuadrante') !!}
                            {!! Form::text('cuadrante',$diente->cuadrante,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sextante', 'Sextante') !!}
                            {!! Form::text('sextante',$diente->sextante,['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('ausente', 'Ausente') !!}
                            {!! Form::select('ausente',array('1'=>'Si','0'=>'No'),$diente->ausente,['class' => 'form-control', 'required']) !!}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='student')
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin del profesor') !!}
                            <input id="pin" type="password" class="form-control" name="pin" required>
                        </div>
                        @endif
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
