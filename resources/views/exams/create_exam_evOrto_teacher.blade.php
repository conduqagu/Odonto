@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Examen inicial</h5></div>

                    <div class="card-body">
                        @include('flash::message')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherevOrto',$exam->id],'method'=>'PUT']) !!}
                        <div>
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name.' '.$exam->patient->surname) !!}
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: ') !!}
                            {!! Form::label('date',\Carbon\Carbon::parse($exam->date)->format('d-m-Y')) !!}                        </div>
                        <div>
                            {!!  Form::label('orto_id' , 'Ortodoncia principal: *') !!}
                            {!!  Form::select('orto_id',$ortodoncias,null, ['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('previsto' , 'Previsto: ') !!}
                            {!! Form::text('previsto',null, ['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!!  Form::label('maxilar' , 'Maxilar: ') !!}
                            {!! Form::text('maxilar',null, ['class'=>'form-control','maxlength'=>"191"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('mandibular' , 'Mandibular: ') !!}
                            {!! Form::text('mandibular',null, ['class'=>'form-control','maxlength'=>"191"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('logrado' , 'Logrado: ') !!}
                            {!! Form::text('logrado',null, ['class'=>'form-control','maxlength'=>"191" ]) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros:') !!}
                            {!! Form::text('otros', null, ['class'=>'form-control','maxlength'=>"191"]) !!}
                            <br>
                        </div>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}



                    </div>
                </div>
                <p>(*): Campos obligatorios</p>
            </div>
        </div>
    </div>
@endsection
