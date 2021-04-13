@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Exámenes</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => ['examsCreateTeacher',$id], 'method' => 'get']) !!}
                        {!!   Form::submit('Realizar examen', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                        <br>
                        <div  class="form-group" >
                            <b>{!!  Form::label('paciente' , 'Paciente: '.$patient->name." ".$patient->surname) !!}
                            </b>
                        </div>

                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fecha del examen</th>
                                <th>Tipo Examen</th>

                                <th colspan="3">Acciones</th>
                            </tr>


                            @foreach ($exams as $exam)
                                <tr>

                                    <td>{{ $exam->date }}</td>
                                    <td>{{ $exam->tipoExam}}</td>

                                    <td>
                                        {!! Form::open(['route' => ['exams.show',$exam->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-primary'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
