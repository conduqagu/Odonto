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
                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherOrtodoncia',$exam->id],'method'=>'PUT']) !!}
                        <div>
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name.' '.$exam->patient->surname) !!}
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: ') !!}
                            {!! Form::label('date',\Carbon\Carbon::parse($exam->date)->format('d-m-Y')) !!}                        </div>
                        <div class="form-group">
                            {!!  Form::label('patronFacial' , 'Patrón Facial: *') !!}
                            {!! Form::select('patronFacial', array('dolicofacial'=>'Dolicofacial','mesofacial'=>'Mesofacial','braquifacial'=>'Braquifacial'),null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('perfil' , 'Perfil: *') !!}
                            {!! Form::select('perfil', array('armonico'=>'Armónico','convexo'=>'Convexo','concavo'=>'Concavo','plano'=>'Plano'),null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('menton' , 'Mentón: *') !!}
                            {!! Form::select('menton', array('marcado'=>'Marcado','normal'=>'Normal','retruido'=>'Retruido','plano'=>'Plano'),'normal',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros:') !!}
                            {!! Form::text('otros', $exam->otros, ['class'=>'form-control','maxlength'=>"255"]) !!}
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
