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
                            {!! Form::text('nombre',null,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('tipo_diagnostico_id', 'Tipo') !!}
                            <br>
                            {!! Form::select('tipo_diagnostico_id', $tipo_diagnosticos, $diagnostico,['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
