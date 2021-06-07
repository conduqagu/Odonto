@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Estudio diente </div>

                    <div class="card-body">
                        <div class="title m-b-md">
                            <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                                <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                            </a>
                        </div>
                        <br>
                        <div>
                            {!! Form::open(['route' => ['exams.show',$exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Detalle examen', ['class'=> 'btn btn-outline-dark'])!!}
                            {!! Form::close() !!}
                        </div>
                        <br>
                        <table class="table table-striped table-bordered">


                            <tr>
                                <th>Diente</th>
                                <th>Dentición raíz</th>
                                <th>Dentición corona</th>
                                <th>Tratamiento</th>
                                <th>Opacidad</th>
                                <th colspan="2">Acciones</th>

                            </tr>
                            @foreach ($asociacion_exam_dientes as $asociacion_exam_diente)
                                <tr>
                                    <td>{{ $asociacion_exam_diente->diente->number}} -
                                        {{ $asociacion_exam_diente->diente->name}}</td>
                                    <td>{{ $asociacion_exam_diente->denticionRaiz }}</td>
                                    <td>{{ $asociacion_exam_diente->denticionCorona }}</td>
                                    <td>@foreach($asociacion_exam_diente->tratamiento as $tratamiento)
                                        {{$tratamiento->tipoTratamiento->name}}<br>
                                    @endforeach</td>
                                    <td>{{ $asociacion_exam_diente->opacidad }}</td>
                                    <td>
                                        @if(Auth::user()->userType =='student')
                                            {!! Form::open(['route' => ['edit_asociacionED',$asociacion_exam_diente->id], 'method' => 'get']) !!}
                                            {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                            {!! Form::close() !!}

                                        @endif
                                        @if(Auth::user()->userType =='teacher')
                                                {!! Form::open(['route' => ['editasociacionEDTeacher',$asociacion_exam_diente->id], 'method' => 'get']) !!}
                                                {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                                {!! Form::close() !!}
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        @if(sizeof($asociacion_exam_dientes)==0)
                            {!! Form::open(['route' => ['create_asociacionED',$exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Realizar examen dental', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                            <br>
                        @endif
                        <td>
                            {!! Form::open(['route' => ['exams.show',$exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Detalle examen', ['class'=> 'btn btn-outline-dark'])!!}
                            {!! Form::close() !!}
                        </td>
                    </div>
                </div>
            </div>
        </div>
@endsection
