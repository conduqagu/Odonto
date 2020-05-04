@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Exámenes</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'exams.create', 'method' => 'get']) !!}
                        {!!   Form::submit('Realizar examen', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Paciente</th>
                                <th>Fecha del examen</th>
                                <th>Aspecto Extraoral Normal</th>
                                <th>Patología mucosa</th>
                                <th>Angle</th>
                                <th>Lateral</th>
                                <th>Dentición</th>
                                <th>Desviación Línea Media</th>

                                <th colspan="3">Acciones</th>
                            </tr>


                            @foreach ($exams as $exam)
                                <tr>

                                    <td>{{ $exam->patient->name}}</td>
                                    <td>{{ $exam->date }}</td>
                                    @if($exam->aspectoExtraoralNormal==1)
                                        <td>Si</td>
                                    @else
                                        <td>No</td>
                                    @endif
                                    <td>{{ $exam->patologiaMucosa}}</td>
                                    <td>{{ $exam->claseAngle}}</td>
                                    <td>{{ $exam->lateralAngle}}</td>
                                    <td>{{ $exam->tipoDentición}}</td>
                                    @if($exam->desviacionLineaMedia==1)
                                        <td>Si</td>
                                    @else
                                        <td>No</td>
                                    @endif

                                    <td>
                                        {!! Form::open(['route' => ['exams.show',$exam->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-outline-dark'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['exams.edit',$exam->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['exams.destroy',$exam->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
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
