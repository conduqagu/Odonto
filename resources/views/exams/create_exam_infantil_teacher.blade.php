@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Examen inicial</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherInfantil',$exam->id],'method'=>'PUT']) !!}
                        <div>
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name) !!}
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: '.$exam->date) !!}
                        </div>
                        <div>
                            {!!  Form::label('aspectoGeneral' , 'Aspecto General') !!}
                            {!! Form::text('aspectoGeneral',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('talla' , 'Talla') !!}
                            {!! Form::text('talla',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('peso' , 'Peso') !!}
                            {!! Form::text('peso',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('piel' , 'Piel') !!}
                            {!! Form::text('piel',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('anomaliaForma' , 'Anomalía en forma') !!}
                            {!! Form::text('anomaliaForma',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('anomaliaTamaño' , 'Anomalía en tamaño') !!}
                            {!! Form::text('anomaliaTamaño',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros') !!}
                            {!! Form::text('otros', $exam->otros, ['class'=>'form-control']) !!}
                            <br>
                        </div>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
