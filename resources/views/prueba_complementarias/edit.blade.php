@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar prueba complementaria</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($prueba_complementaria, [ 'route' => ['prueba_complementarias.update',$prueba_complementaria->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre',$prueba_complementaria->nombre,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fichero', 'Fichero') !!}
                            {!! Form::text('fichero',$prueba_complementaria->fichero,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('comentario', 'Comentario') !!}
                            {!! Form::text('comentario',$prueba_complementaria->comentario,['class'=>'form-control', 'autofocus']) !!}
                        </div>
                        <br>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
