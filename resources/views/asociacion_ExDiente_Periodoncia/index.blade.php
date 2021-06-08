@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                <div class="card"  style="width: max-content">
                    <div class="card-header"><h5>Estudio diente</h5></div>
                    <div class="card-body">
                        <div class="title m-b-md">
                            <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                                <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                            </a>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Diente</th>
                                <th>Furca</th>
                                <th>Retraccion</th>
                                <th>Hipertrofia</th>
                                <th>Sondaje</th>
                                <th>Movilidad</th>
                                <th>Sangrado</th>
                                <th>Encía insertada</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                            @foreach ($asociacion_exam_dientes as $asociacion_exam_diente)
                                <tr>
                                    <td>{{ $asociacion_exam_diente->diente->number}} -
                                        {{ $asociacion_exam_diente->diente->name}}</td>
                                    <td>{{ $asociacion_exam_diente->furca }}</td>
                                    <td>{{ $asociacion_exam_diente->retraccion }}</td>
                                    <td>{{ $asociacion_exam_diente->hipertrofia }}</td>
                                    @if($asociacion_exam_diente->sondaje==1)
                                        <td><FONT COLOR="blue">{{'Si'}}</FONT></td>
                                    @else
                                        <td>{{'No'}}</td>
                                    @endif
                                    @if($asociacion_exam_diente->movilidad==1)
                                        <td><FONT COLOR="blue">{{'Si'}}</FONT></td>
                                    @else
                                        <td>{{'No'}}</td>
                                    @endif
                                    @if($asociacion_exam_diente->sangrado==1)
                                        <td><FONT COLOR="blue">{{'Si'}}</FONT></td>
                                    @else
                                        <td>{{'No'}}</td>
                                    @endif
                                    @if($asociacion_exam_diente->encia_insertada==1)
                                        <td><FONT COLOR="blue">{{'Si'}}</FONT></td>
                                    @else
                                        <td>{{'No'}}</td>
                                    @endif
                                    <td>
                                        {!! Form::open(['route' => ['edit_asociacionEDPeriodoncia',$asociacion_exam_diente->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @if(sizeof($asociacion_exam_dientes)==0 && \Illuminate\Support\Facades\Auth::user()->userType!='admin')
                            {!! Form::open(['route' => ['create_asociacionEDPeriodoncia',$exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Realizar examen dental', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                        @endif
                        <br>
                            {!! Form::open(['route' => ['exams.show',$exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Detalle examen', ['class'=> 'btn btn-outline-dark'])!!}
                            {!! Form::close() !!}
                    </div>
                </div>
        </div>
@endsection
