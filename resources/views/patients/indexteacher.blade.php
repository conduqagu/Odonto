@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Pacientes</h5> </div>

                    <div class="panel-body">
                        @include('flash::message')
                            <div class="row align-items-start">
                                <div class="col-2">
                                    {!! Form::open(['route' => 'createteacher', 'method' => 'get']) !!}
                                    {!!   Form::submit('Crear paciente', ['class'=> 'btn btn-primary button-align'])!!}
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-10">
                                {!! Form::model(\Illuminate\Support\Facades\Request::all(),['route' => ['indexteacher'], 'method' => 'get']) !!}
                                {!! Form::text('query_patient_t',$query_patient_t,['class'=>'col-md-3 form-control', 'autofocus', 'placeholder'=>'Nombre, apellido o DNI',
                                'style'=>'display:inline-block; float:right;margin-left: 25px;']) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary button-align-right', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary button-align-right','name'=>'semibutton'])!!}
                                {!! Form::close() !!}
                                </div>
                            </div>

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre y Apellidos</th>
                                <th>DNI</th>
                                <th colspan="4">Acciones</th>
                            </tr>

                            @foreach ($patients as $patient)
                                <tr style="word-break: break-word;">
                                    <td  style="max-width: 78px;">{{ $patient->name.' '.$patient->surname }}</td>

                                    <td>{{ $patient->dni }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['patients.show',$patient->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-primary'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        {{$patients->render()}}
                        {!! Form::open(['route' => ['home'], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection
