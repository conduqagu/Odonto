@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Examen inicial</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherOrtodoncia',$exam->id],'method'=>'PUT']) !!}
                        <div>
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name) !!}
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: '.$exam->date) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('patronFacial' , 'Patrón Facial') !!}
                            {!! Form::select('patronFacial', array('dolicofacial'=>'Dolicofacial','mesofacial'=>'Mesofacial','braquifacial'=>'Braquifacial'),null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('perfil' , 'Perfil') !!}
                            {!! Form::select('perfil', array('armonico'=>'Armónico','convexo'=>'Convexo','concavo'=>'Concavo','plano'=>'Plano'),null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!!  Form::label('menton' , 'Mentón') !!}
                            {!! Form::select('menton', array('marcado'=>'Marcado','normal'=>'Normal','retruido'=>'Retruido','plano'=>'Plano'),'normal',['class' => 'form-control', 'required']) !!}
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
