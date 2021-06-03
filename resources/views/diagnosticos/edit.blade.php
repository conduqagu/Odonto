@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar diagnostico</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($diagnostico, [ 'route' => ['diagnosticos.update',$diagnostico->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre',$diagnostico->nombre,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
