@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Examen inicial</h5></div>

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
                            {!!  Form::label('orto_id' , 'Ortodoncia principal') !!}
                            {!! Form::select('orto_id',$ortodoncias, ['class'=>'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('previsto' , 'Previsto') !!}
                            {!! Form::text('previsto',null, ['class'=>'form-control','maxlength'=>"255"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('maxilar' , 'Maxilar') !!}
                            {!! Form::text('maxilar',null, ['class'=>'form-control','maxlength'=>"255"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('mandibular' , 'Mandibular') !!}
                            {!! Form::text('mandibular',null, ['class'=>'form-control','maxlength'=>"255"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('logrado' , 'Logrado') !!}
                            {!! Form::text('logrado',null, ['class'=>'form-control','maxlength'=>"255"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros') !!}
                            {!! Form::text('otros', $exam->otros, ['class'=>'form-control','maxlength'=>"255"]) !!}
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
