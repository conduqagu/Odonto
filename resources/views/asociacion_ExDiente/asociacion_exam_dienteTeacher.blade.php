@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
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
                                <th>Dentición raíz</th>
                                <th>Dentición corona</th>
                                <th>Tratamiento</th>
                                <th>Opacidad</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                <th colspan="2">Acciones</th>
                                @else
                                    <th>DNI Profesor</th>
                                @endif
                            </tr>
                            @foreach ($asociacion_exam_dientes as $asociacion_exam_diente)
                                <tr>
                                    <td>{{ $asociacion_exam_diente->diente->number}} -
                                        {{ $asociacion_exam_diente->diente->name}}</td>
                                    <td>{{ $asociacion_exam_diente->denticionRaiz }}</td>
                                    <td>{{ $asociacion_exam_diente->denticionCorona }}</td>
                                    <td>@foreach($asociacion_exam_diente->tratamiento as $tratamiento)
                                            {{$tratamiento->tipoTratamiento->name}}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $asociacion_exam_diente->opacidad }}</td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                    <td>
                                        {!! Form::open(['route' => ['editasociacionEDTeacher',$asociacion_exam_diente->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    @else
                                    <td>
                                        @if($asociacion_exam_diente->teacher_id!=null)
                                            {{\App\User::find($asociacion_exam_diente->teacher_id)->dni}}
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                        @if(sizeof($asociacion_exam_dientes)==0 && \Illuminate\Support\Facades\Auth::user()->userType!='admin')
                            {!! Form::open(['route' => ['create_asociacionED',$exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Realizar examen dental', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                        @endif
                        <br>
                            {!! Form::open(['route' => ['exams.show',$exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Detalle examen', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
