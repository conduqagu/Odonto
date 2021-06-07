@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Estudio diente</div>
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
                                    <td>{{ $asociacion_exam_diente->tipo_tratamiento->name }}</td>
                                    <td>{{ $asociacion_exam_diente->opacidad }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['editasociacionEDTeacher',$asociacion_exam_diente->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @if(sizeof($asociacion_exam_dientes)==0)
                            {!! Form::open(['route' => ['create_asociacionED',$exam_id], 'method' => 'get']) !!}
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
        </div>
@endsection
