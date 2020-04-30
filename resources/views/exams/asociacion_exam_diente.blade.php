@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Estudio diente </div>

                    <div class="card-body">

                        <br><br>
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
                                    <td>{{ $asociacion_exam_diente->diente->name}}</td>
                                    <td>{{ $asociacion_exam_diente->denticionRaiz }}</td>
                                    <td>{{ $asociacion_exam_diente->denticionCorona }}</td>
                                    <td>{{ $asociacion_exam_diente->tratamiento }}</td>
                                    <td>{{ $asociacion_exam_diente->opacidad }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['edit_asociacionED',$asociacion_exam_diente->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
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
