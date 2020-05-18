@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear pin</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'storepin']) !!}
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin') !!}
                            {!! Form::text('pin',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
