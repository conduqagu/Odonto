@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar diagnostico</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($diagnostico, [ 'route' => ['diagnosticos.update',$diagnostico->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre',$diagnostico->nombre,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}

                        {!! Form::close() !!}
                        <a class="btn btn-outline-dark button-align-right " style="margin-bottom: 15px" href="{{ url()->previous() }}">
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
