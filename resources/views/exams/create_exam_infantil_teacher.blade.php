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
                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherInfantil',$exam->id],'method'=>'PUT']) !!}
                        <div>
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name.' '.$exam->patient->surname) !!}
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: ') !!}
                            {!! Form::label('date',\Carbon\Carbon::parse($exam->date)->format('d-m-Y')) !!}

                        </div>
                        <div>
                            {!!  Form::label('aspectoGeneral' , 'Aspecto General: *') !!}
                            {!! Form::text('aspectoGeneral',null, ['class'=>'form-control','maxlength'=>"191",'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('talla' , 'Talla: ') !!}
                            {!! Form::text('talla',null, ['class'=>'form-control','maxlength'=>"191"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('peso' , 'Peso:') !!}
                            {!! Form::text('peso',null, ['class'=>'form-control','maxlength'=>"191"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('piel' , 'Piel:') !!}
                            {!! Form::text('piel',null, ['class'=>'form-control','maxlength'=>"191"]) !!}
                        </div>
                        <div>
                            {!!  Form::label('anomaliaForma' , 'Anomalía en forma: *') !!}
                            {!! Form::text('anomaliaForma',null, ['class'=>'form-control','maxlength'=>"191",'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('anomaliaTamaño' , 'Anomalía en tamaño: *') !!}
                            {!! Form::text('anomaliaTamaño',null, ['class'=>'form-control','maxlength'=>"191",'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros:') !!}
                            {!! Form::text('otros', $exam->otros, ['class'=>'form-control','maxlength'=>"191"]) !!}
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
