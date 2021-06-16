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
                            @if($query?? ''!=null)
                                {!! Form::open(['route' => ['indexExamsAdmin'], 'method' => 'get']) !!}
                                {!! Form::select('query', array('inicial'=>'Inicial','infantil'=>'Infantil','periodoncial'=>'Periodoncial',
                                    'ortodoncial'=>'Ortodoncial','evOrto'=>'Evaluación ortodoncia','otro'=>'Otro',null=>'Tipo de examen'), $query->get("query"),
                                    ['class'=>'col-md-3  form-control','autofocus','style'=>'display:inline-block']) !!}
                                {!! Form::date('query2', $query->get("query2"),['class'=>'col-md-3  form-control','autofocus','paceholder'=>'Fecha','style'=>'display:inline-block']) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary form-control float: left;', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary ','name'=>'semibutton'])!!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['indexExamsAdmin'], 'method' => 'get']) !!}
                                {!! Form::select('query', array('inicial'=>'Inicial','infantil'=>'Infantil','periodoncial'=>'Periodoncial',
                                    'ortodoncial'=>'Ortodoncial','evOrto'=>'Evaluación ortodoncia','otro'=>'Otro',null=>'Tipo de examen'), null,
                                    ['class'=>'col-md-3 form-control','autofocus' ,'style'=>'display:inline-block']) !!}
                                {!! Form::date('query2', null,['class'=>'col-md-3 form-control ','autofocus','paceholder'=>'Fecha', 'style'=>'display:inline-block']) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary ','name'=>'semibutton'])!!}
                                {!! Form::close() !!}
                            @endif

                        </div>
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
                                    <td>{{ $exam->date}}</td>
                                    @if($exam->tipoExam=='evOrto')
                                        <td>{{ 'Evaluación ortodoncia' }}</td>
                                    @else
                                        <td>{{ $exam->tipoExam}}</td>
                                    @endif

                                    <td>
                                        @if($exam->teacher_id!=null)
                                            {{App\User::find($exam->teacher_id)->dni}}
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

                        @if(Auth::user()->userType =='teacher')
                            {!! Form::open(['route' => ['indexteacher'], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark'])!!}
                            {!! Form::close() !!}
                        @endif
                        @if(Auth::user()->userType =='student')
                            {!! Form::open(['route' => ['patients.index'], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark'])!!}
                            {!! Form::close() !!}
                        @endif

                    </div>
                </div>
            </div>
        </div>
@endsection
