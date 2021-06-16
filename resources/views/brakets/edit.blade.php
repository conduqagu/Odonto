@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar brackets</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($braket, [ 'route' => ['brakets.update',$braket->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name',$braket->name,['class'=>'form-control', 'required', 'autofocus','maxlength'=>"255"]) !!}
                        </div>


                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}

                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['brakets.index'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
