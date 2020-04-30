@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Añadir alumno a paciente</div>

                    <div class="card-body">
                        @include('flash::message')
                        {!! Form::open(['route' => ['storeAlumno',$patient->id], 'method' => 'get']) !!}
                        <div>
                            {!!Form::label('student_id', 'Estudiante a asignar') !!}
                            <br>
                            {!! Form::select('student_id', $students, ['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Añadir',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
