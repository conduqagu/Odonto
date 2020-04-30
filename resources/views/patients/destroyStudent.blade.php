@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Eliminar alumno de paciente</div>

                    <div class="card-body">
                        @include('flash::message')
                        {!! Form::open(['route' => ['deleteStudent',$patient->id], 'method' => 'delete']) !!}
                        <div>
                            {!!Form::label('student_id', 'Estudiante a asignar') !!}
                            <br>
                            {!! Form::select('student_id', $students, ['class' => 'form-control', 'required']) !!}
                        </div>
                        {!! Form::submit('Eliminar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
