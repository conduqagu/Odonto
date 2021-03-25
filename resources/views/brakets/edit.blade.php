@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar tipo diagnostico</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($braket, [ 'route' => ['tipo_diagnosticos.update',$braket->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',$braket->name,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>


                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
