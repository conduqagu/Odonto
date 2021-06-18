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

                                    {!! Form::open(['route' => ['indexExamsAdmin'], 'method' => 'get']) !!}
                                    {!! Form::select('query_exam_admin', array('inicial'=>'Inicial','infantil'=>'Infantil','periodoncial'=>'Periodoncial',
                                        'ortodoncial'=>'Ortodoncial','evOrto'=>'Evaluación ortodoncia','otro'=>'Otro',null=>'Tipo de examen'), $query_exam_admin,
                                        ['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block; float:right;
                                    margin-left: 25px;']) !!}
                                    {!! Form::date('query_exam_admin2', $query_exam_admin2,['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block; float:right;
                                    margin-left: 25px;', 'paceholder'=>'Fecha']) !!}
                                    {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary button-align-right ', 'name'=>'semibutton'])!!}
                                    {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary button-align-right','name'=>'semibutton'])!!}
                                    {!! Form::close() !!}

                        </div>
                        <br>

                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Paciente</th>
                                <th>Fecha del examen</th>
                                <th>Tipo Examen</th>
                                <th>Profesor</th>

                                <th colspan="3">Acciones</th>
                            </tr>


                            @foreach ($exams as $exam)
                                <tr>

                                    <td>{{ $exam->patient->name." ".$exam->patient->surname }}</td>
                                    <td>{{ \Carbon\Carbon::parse($exam->date)->format('d-m-Y')}}</td>
                                    @if($exam->tipoExam=='evOrto')
                                        <td>{{ 'Evaluación ortodoncia' }}</td>
                                    @else
                                        <td>{{ $exam->tipoExam}}</td>
                                    @endif

                                    <td>
                                        @if($exam->teacher_id!=null)
                                            {{App\User::find($exam->teacher_id)->dni}}
                                        @else
                                            {{"N/D"}}
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['exams.show',$exam->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-primary'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        {{$exams->render()}}

                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection
