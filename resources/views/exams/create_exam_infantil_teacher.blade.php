@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Examen inicial</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherInicial',$exam->id],'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name) !!}
                            <br>
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: '.$exam->date) !!}
                        </div>
                        <div>
                            {!!  Form::label('aspectoExtraoralNormal' , 'Aspecto Extraoral Normal') !!}
                            {!! Form::select('aspectoExtraoralNormal', array('1'=>'Si','0'=>'No'),'1',['class' => 'form-control', 'required']) !!}
                        </div>

                        <div>
                            {!!  Form::label('otros' , 'Otros') !!}
                            {!! Form::text('otros', $exam->otros, ['class'=>'form-control']) !!}
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
