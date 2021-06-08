@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Exámenes</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        <div class="form-group" >
                            {!! Form::open(['route' => ['exams.index',$patient], 'method' => 'get']) !!}
                            {!! Form::select('query',array('inicial'=>'Inicial','infantil'=>'Infantil','periodoncial'=>'Periodoncial',
                                'ortodoncial'=>'Ortodoncial','evOrto'=>'Evaluación ortodoncia','otro'=>'Otro',null=>'Tipo de examen'), null,
                                ['class'=>'col-md-2','autofocus']) !!}
                            {!! Form::date('query2',null,['class'=>'col-md-2','autofocus','paceholder'=>'Fecha']) !!}
                            {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary'])!!}
                            {!! Form::close() !!}
                        </div>

                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')
                        {!! Form::open(['route' => ['examsCreateTeacher',$id], 'method' => 'get']) !!}
                        {!!   Form::submit('Realizar examen', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                        @elseif(\Illuminate\Support\Facades\Auth::user()->userType=='student')
                            {!! Form::open(['route' => ['exams.create',$id], 'method' => 'get']) !!}
                            {!!   Form::submit('Realizar examen', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                        @endif
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
                                    @if($exam->tipoExam=='evOrto')
                                        <td>{{ 'Evaluación ortodoncia' }}</td>
                                    @else
                                        <td>{{ $exam->tipoExam}}</td>
                                    @endif

                                    <td>
                                        {!! Form::open(['route' => ['exams.show',$exam->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-primary'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>

                        @if(Auth::user()->userType =='teacher')
                            {!! Form::open(['route' => ['indexteacher'], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                            {!! Form::close() !!}
                        @endif
                        @if(Auth::user()->userType =='student')
                            {!! Form::open(['route' => ['patients.index'], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                            {!! Form::close() !!}
                        @endif

                    </div>
                </div>
            </div>
        </div>
@endsection
