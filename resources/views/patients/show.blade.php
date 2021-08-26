@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header"><h5>Información del paciente</h5></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('name', 'Nombre: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    {!! Form::label('name',$patient->name) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('telefono', 'Télefono: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    @if($patient->telefono!=null)
                                        {!! Form::label('telefono',$patient->telefono) !!}
                                    @else
                                        {!! "N/D" !!}
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', 'Correo electrónico: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    {!! Form::label('email',$patient->email) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('dni', 'DNI: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    {!! Form::label('dni',$patient->dni) !!}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('surname', 'Apellidos: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    {!! Form::label('surname',$patient->surname) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('fechaNacimiento', 'Fecha de nacimiento: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    {!! Form::label('fechaNacimiento',\Carbon\Carbon::parse($patient->fechaNacimiento)->format('d-m-Y')) !!}
                                </div>
                                <div>
                                    {!!  Form::label('child' , 'Infantil: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    @if($patient->child=0)
                                        {!! Form::label('child', "No") !!}
                                    @else
                                        {!! Form::label('child', "Si") !!}
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    {!!  Form::label('riesgoASA' , 'Riesgo ASA: ', [ 'style' => 'font-weight:bold', ]) !!}
                                    {!! Form::label('riesgoASA', $patient->riesgoASA) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('observaciones', 'Observaciones: ', [ 'style' => 'font-weight:bold', ]) !!}
                            @if($patient->observaciones!=null)
                                {!! Form::label('observaciones',$patient->observaciones) !!}
                            @else
                                {!! "N/D" !!}
                            @endif
                        </div>
                    </div>
                </div>
                <br>

                <div class="card" >
                    <div class="card-header"><h5>Exámenes</h5></div>
                    <div class="card-body">
                        <div class="row align-items-start">

                            <div class="col-1">
                                @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')
                                    {!! Form::open(['route' => ['examsCreateTeacher',$patient->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Realizar examen', ['class'=> 'btn btn-primary button-align'])!!}
                                    {!! Form::close() !!}
                                @elseif(\Illuminate\Support\Facades\Auth::user()->userType=='student')
                                    {!! Form::open(['route' => ['exams.create',$patient->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Realizar examen', ['class'=> 'btn btn-primary button-align'])!!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-11">
                                {!! Form::open(['route' => ['patients.show',$patient->id], 'method' => 'get','style'=>'text-align:right']) !!}
                                {!! Form::select('query', array('inicial'=>'Inicial','infantil'=>'Infantil','periodoncial'=>'Periodoncial',
                                    'ortodoncial'=>'Ortodoncial','evOrto'=>'Evaluación ortodoncia','otro'=>'Otro',null=>'Tipo de examen'),
                                    $query,['class'=>'col-md-3 form-control','autofocus' ,'style'=>'display:inline-block;
                                margin-left: 25px;']) !!}
                                {!! Form::date('query2',$query2,['class'=>'col-md-3 form-control ','autofocus','paceholder'=>'Fecha',
                                'style'=>'display:inline-block; margin-left: 25px;']) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary','name'=>'semibutton'])!!}
                                {!! Form::hidden('query3',old('query3')) !!}
                                {!! Form::hidden('query4',old('query4')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fecha del examen</th>
                                <th>Tipo Examen</th>

                                <th colspan="3">Acciones</th>
                            </tr>


                            @foreach ($exams as $exam)
                                <tr>

                                    <td>{{ \Carbon\Carbon::parse($exam->date)->format('d-m-Y') }}</td>
                                    @if($exam->tipoExam=='evOrto')
                                        <td>{{ 'Evaluación ortodoncia' }}</td>
                                    @else
                                        <td>{{ $exam->tipoExam}}</td>
                                    @endif

                                    <td>
                                        {!! Form::open(['route' => ['exams.show',$exam->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Ver detalle', ['class'=> 'btn btn-primary'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        {{$exams->appends(['query' => $query ?? '','query2' => $query2 ?? '','query3' => $query3 ?? ''
                        ,'query4' => $query4 ?? ''])->links()}}
                    </div>
                </div>
                <br>
                <div class="card" >
                    <div class="card-header"><h5>Dientes</h5></div>
                    <div class="card-body">
                        <div class="row align-items-start">

                            <div class="col">
                                {!! Form::open(['route' => ['diente.create',$patient->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Crear diente', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-10">
                                {!! Form::open(['route' => ['patients.show',$patient->id], 'method' => 'get','style'=>'text-align:right']) !!}
                                {!! Form::text('query3',$query3,['class'=>'col-md-3 form-control','autofocus' ,'style'=>'display:inline-block;
                                margin-left: 25px;','placeholder'=>'Nombre o número', 'maxlength'=>"50"]) !!}
                                {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton2'])!!}
                                {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary ','name'=>'semibutton2'])!!}
                                {!! Form::hidden('query',old('query')) !!}
                                {!! Form::hidden('query2',old('query2')) !!}
                                {!! Form::hidden('query4',old('query4')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <br>
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
                        {{$dientes->appends(['query' => $query ?? '','query2' => $query2 ?? '','query3' => $query3 ?? ''
                        ,'query4' => $query4 ?? ''])->links()}}

                    </div>
                </div>
                <br>
                @if(Auth::user()->userType =='teacher')

                <div class="card" >
                    <div class="card-header"><h5>Alumnos</h5></div>
                    <div class="card-body">
                        <div class="form-group" >
                            {!! Form::open(['route' => ['patients.show',$patient->id], 'method' => 'get','style'=>'text-align:right']) !!}
                            {!! Form::text('query4',$query4,['class'=>'col-md-3 form-control', 'autofocus', 'style'=>'display:inline-block;
                                margin-left: 25px;','placeholder'=>'Nombre, apellido o DNI', 'maxlength'=>"50"]) !!}
                            {!! Form::submit('Buscar', ['class'=> 'btn btn-success boton-primary ', 'name'=>'semibutton3'])!!}
                            {!! Form::submit('Borrar filtro', ['class'=> 'btn btn-primary boton-primary','name'=>'semibutton3'])!!}
                            {!! Form::hidden('query',old('query')) !!}
                            {!! Form::hidden('query2',old('query2')) !!}
                            {!! Form::hidden('query3',old('query3')) !!}
                            {!! Form::close() !!}

                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th colspan="4">Acciones</th>
                            </tr>
                            @foreach ($students_all as $student2)
                                <tr>
                                    <td>{{ $student2->name }}</td>
                                    <td>{{ $student2->surname }}</td>
                                    <td>{{ $student2->dni }}</td>
                                    <td>
                                        @if($students_si->contains($student2))
                                            {!! Form::open(['route' => ['deleteStudent',$student2->id], 'method' => 'delete']) !!}
                                            {{Form::hidden('patient_id',$patient->id)}}
                                            {!!   Form::submit('Eliminar de este paciente', ['class'=> 'btn btn-danger button-align' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                            {!! Form::close() !!}
                                        @else
                                            {!! Form::open(['route' => ['storeAlumno',$student2->id], 'method' => 'get']) !!}
                                            {!! Form::hidden('patient_id',$patient->id) !!}
                                            {!!   Form::submit('Añadir a este paciente', ['class'=> 'btn btn-primary' ])!!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{$students_all->appends(['query' => $query ?? '','query2' => $query2 ?? '','query3' => $query3 ?? ''
                        ,'query4' => $query4 ?? ''])->links()}}


                    </div>
                </div>
                <br>


                    <div>
                    {!! Form::open(['route' => ['editteacher',$patient->id], 'method' => 'get']) !!}
                    {!!   Form::submit('Editar', ['class'=> 'btn btn-warning button-align'])!!}
                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['patientdestroy',$patient->id], 'method' => 'delete']) !!}
                    {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger button-align' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                    {!! Form::close() !!}
                    {!! Form::open(['route' => ['indexteacher'], 'method' => 'get']) !!}
                    {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                    {!! Form::close() !!}
                    </div>
                @endif
                @if(Auth::user()->userType =='student')
                    {!! Form::open(['route' => ['patients.edit',$patient->id], 'method' => 'get']) !!}
                    {!!   Form::submit('Editar', ['class'=> 'btn btn-warning button-align'])!!}
                    {!! Form::close() !!}

                    {!! Form::open(['route' => ['patients.index'], 'method' => 'get']) !!}
                    {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                    {!! Form::close() !!}
                @endif

            </div>
        </div>
    </div>
@endsection
