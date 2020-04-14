@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear examen</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'exams.store']) !!}
                        <div class="form-group">
                            {!! Form::label('date', 'Fecha') !!}
                            {!! Form::date('date',null,['class'=>'form-control', 'required']) !!}
                        </div>
                        {!!  Form::label('Aspecto Extraoral Normal' , 'Riesgo ASA') !!}
                        {!! Form::select('aspectoExtraoralNormal',null, array('si'=>'True','No'=>'False')) !!}
                    </div>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
