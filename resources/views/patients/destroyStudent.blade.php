@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Eliminar Alumno de paciente</div>

                    <div class="panel-body">
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
