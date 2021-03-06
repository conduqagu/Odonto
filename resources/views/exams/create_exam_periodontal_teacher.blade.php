@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Examen inicial</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherPeriodoncial',$exam->id],'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name) !!}
                            <br>
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: '.$exam->date) !!}
                        </div>
                        <div>
                            {!!  Form::label('indicePlaca' , 'Índice de placa') !!}
                            {!! Form::text('indicePlaca', null,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('indicePlaca' , 'Índice de placa') !!}
                            {!! Form::select('indicePlaca', array('rosa'=>'Rosa','rojo'=>'Rojo'),'rosa',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('borde' , 'Borde') !!}
                            {!! Form::select('borde', array('afilado'=>'Afilado','engrosado'=>'Engrosado'),'afilado',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('aspecto' , 'Aspecto') !!}
                            {!! Form::select('aspecto', array('puntillado'=>'Puntillado','liso'=>'Liso'),'liso',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('consistencia' , 'Consistencia') !!}
                            {!! Form::select('consistencia', array('firme'=>'Firme','depresible'=>'Depresible'),'firme',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('biotipo' , 'Biotipo') !!}
                            {!! Form::number('biotipo', null,['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros') !!}
                            {!! Form::text('otros', null, ['class'=>'form-control']) !!}
                            <br>
                        </div>

                        {!! Form::submit('Continuar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
