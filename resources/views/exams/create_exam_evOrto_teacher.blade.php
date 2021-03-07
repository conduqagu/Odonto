@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Examen inicial</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherevOrto',$exam->id],'method'=>'PUT']) !!}
                        <div>
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name) !!}
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: '.$exam->date) !!}
                        </div>
                        <div>
                            {!!  Form::label('previsto' , 'Previsto') !!}
                            {!! Form::text('previsto',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('maxilar' , 'Maxilar') !!}
                            {!! Form::text('maxilar',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('mandibular' , 'Mandibular') !!}
                            {!! Form::text('mandibular',null, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('logrado' , 'Logrado') !!}
                            {!! Form::text('logrado',null, ['class'=>'form-control']) !!}
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
