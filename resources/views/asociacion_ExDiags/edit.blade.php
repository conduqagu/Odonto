@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar diagnóstico</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($asociacion, [ 'route' => ['asociacion_ExDiags.update',$asociacion->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::select('diagnostico_id', $diagnosticos, $asociacion->diagnostico->nombre,['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
