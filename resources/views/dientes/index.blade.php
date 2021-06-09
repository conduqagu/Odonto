@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Dientes</h5></div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => ['diente.create',$patient->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Crear diente', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre Común</th>
                                <th>Número</th>
                                <th>Cuadrante</th>
                                <th>Sextante</th>
                                <th>Ausente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($dientes as $diente)
                                <tr>
                                    <td>{{ $diente->name }}</td>
                                    <td>{{ $diente->number }}</td>
                                    <td>{{ $diente->cuadrante }}</td>
                                    <td>{{ $diente->sextante }}</td>
                                    @if($diente->ausente==1)
                                        <td style="color:#FF0000">Si</td>
                                    @else
                                        <td >No</td>
                                    @endif

                                    <td>
                                        {!! Form::open(['route' => ['dientes.edit',$diente->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')
                            {!! Form::open(['route' => ['indexteacher'], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['route' => ['patients.index'], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                            {!! Form::close() !!}
                        @endif

                    </div>
                </div>
            </div>
        </div>
@endsection
