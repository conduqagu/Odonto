@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('flash::message')

                <div class="card">
                    <div class="card-header"><h5>Detalles del examen</h5></div>
                        <div class="card-body">
                            <div >
                                {!! Form::label('date', 'Fecha:') !!}
                                {!! Form::label(\Carbon\Carbon::parse($exam->date)->format('d-m-Y') ) !!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('patient_id', 'Paciente: ') !!}
                                {!! Form::label( $exam->patient->name)." ".Form::label( $exam->patient->surname) !!}
                            </div>
                        </div>
                    </div>
                @if($exam->tipoExam=='inicial')

                <br>
                    <div class="row align-items-start">
                        <div class="col">
                        <div class="card" style="height: 451px;">
                            <div class="card-header"><h5>Mucosas</h5></div>
                            <div class="card-body">
                                <div >
                                    {!!  Form::label('aspectoExtraoralNormal' , 'Aspecto Extraoral Normal: ') !!}
                                    @if($exam->aspectoExtraoralNormal==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('cancerOral' , 'Cancer Oral: ') !!}
                                    @if($exam->cancerOral==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('anomaliasLabios' , 'Anomalias en labios: ') !!}
                                    @if($exam->anomaliasLabios==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('otros' , 'Otros: ') !!}
                                    @if($exam->otros!=null)
                                        {!! Form::label( $exam->otros) !!}
                                    @else
                                        {!! "N/D" !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('patologiaMucosa' , 'Patologías en mucosas: ') !!}
                                    {!! Form::label($exam->patologiaMucosa) !!}
                                </div>
                                <div>
                                    {!!  Form::label('fluorosis' , 'Fluorosis: ') !!}
                                    {!! Form::label($exam->fluorosis) !!}
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col">
                        <div class="card"  style="height: 451px;">
                            <div class="card-header"><h5>Índice Periodontitis comunitario(IPC)</h5></div>
                            <div class="card-body">
                                <div>
                                    {!!  Form::label('estadoS1' , 'Estado primer sextante: ') !!}
                                    {!! Form::label($exam->estadoS1) !!}
                                </div>
                                <div>
                                    {!!  Form::label('estadoS2' , 'Estado segundo sextante: ') !!}
                                    {!! Form::label($exam->estadoS2) !!}
                                </div>
                                <div>
                                    {!!  Form::label('estadoS3' , 'Estado tercer sextante: ') !!}
                                    {!! Form::label( $exam->estadoS3) !!}
                                </div>
                                <div>
                                    {!!  Form::label('estadoS4' , 'Estado cuarto sextante: ') !!}
                                    {!! Form::label($exam->estadoS4) !!}
                                </div>
                                <div>
                                    {!!  Form::label('estadoS5' , 'Estado quinto sextante: ') !!}
                                    {!! Form::label($exam->estadoS5) !!}
                                </div>
                                <div>
                                    {!!  Form::label('estadoS6' , 'Estado sexto sextante: ') !!}
                                    {!! Form::label($exam->estadoS6) !!}
                                </div>
                            </div>
                        </div>
                        </div>
                            <br>
                        <div class="col">

                        <div class="card">
                            <div class="card-header"><h5>Anomalías dentofaciales</h5></div>
                            <div class="card-body">
                                <div>
                                    {!!  Form::label('claseAngle' , 'Angle: ') !!}
                                    {!! Form::label($exam->claseAngle) !!}
                                </div>
                                <div>
                                    {!!  Form::label('lateralAngle' , 'Lateral Angle: ') !!}
                                    {!! Form::label($exam->lateralAngle) !!}
                                </div>
                                <div>
                                    {!!  Form::label('tipoDentición' , 'Tipo Dentición: ') !!}
                                    {!! Form::label($exam->tipoDentición) !!}
                                </div>
                                <div>
                                    {!!  Form::label('apiñamientoIncisivoInferior' , 'Apiñamiento Incisivo Inferior: ') !!}
                                    @if($exam->apiñamientoIncisivoInferior==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('apiñamientoIncisivoSuperior' , 'Apiñamiento Incisivo Superior: ') !!}
                                    @if($exam->apiñamientoIncisivoSuperior==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('perdidaEspacioAnterior' , 'Perdida Espacio Anterior: ') !!}
                                    @if($exam->perdidaEspacioAnterior==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('perdidaEspacioPosterior' , 'Perdida Espacio Posterior: ') !!}
                                    @if($exam->perdidaEspacioPosterior==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('mordidaCruzadaAnterior' , 'Mordida Cruzada Anterior: ') !!}
                                    @if($exam->mordidaCruzadaAnterior==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('mordidaCruzadaPosterior' , 'Mordida Cruzada Posterior: ') !!}
                                    @if($exam->mordidaCruzadaPosterior==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('desviacionLineaMedia' , 'Desviacion Linea Media: ') !!}
                                    @if($exam->desviacionLineaMedia==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('mordidaAbierta' , 'Mordida Abierta: ') !!}
                                    @if($exam->mordidaAbierta==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                                <div>
                                    {!!  Form::label('habitos' , 'Hábitos: ') !!}
                                    @if($exam->habitos==1)
                                        {!! Form::label('Si') !!}
                                    @else
                                        {!! Form::label('No') !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <br>

                    <div class="card" >
                        <div class="card-header"><h5>Examen dental</h5></div>
                        <div class="card-body">
                            <div class="title m-b-md" style="text-align: center;">
                                <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                                    <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                                </a>
                            </div>
                            <br>
                            @if(sizeof($asociacion_exam_dientes)==0 && \Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                {!! Form::open(['route' => ['create_asociacionED',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Realizar examen dental', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['edit_asociacionED',$exam->id], 'method' => 'get', 'style'=>'display: inline']) !!}
                                {!!   Form::submit('Editar', ['class'=> 'btn btn-warning  button-align'])!!}
                                {!! Form::close() !!}
                            @endif
                            <br><br>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Diente</th>
                                    <th>Dentición raíz</th>
                                    <th>Dentición corona</th>
                                    <th>Tratamiento</th>
                                    <th>Opacidad</th>
                                    @if(\Illuminate\Support\Facades\Auth::user()->userType=='admin')
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

                                        @if($asociacion_exam_diente->teacher_id!=null && \Illuminate\Support\Facades\Auth::user()->userType=='admin')
                                            <td>{{\App\User::find($asociacion_exam_diente->teacher_id)->dni}}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>

                                    {{$asociacion_exam_dientes->render()}}


                        </div>
                    </div>
                    @elseif($exam->tipoExam=='infantil')
                        <br>
                        <div class="card">
                            <div class="card-header"><h5>Examen Infantil</h5></div>
                            <div class="card-body">
                                <div>
                                    {!!  Form::label('aspectoGeneral' , 'Aspecto General: '.$exam->aspectoGeneral) !!}
                                    <br>
                                    {!!  Form::label('talla' , 'Talla: '.$exam->talla) !!}
                                    <br>
                                    {!!  Form::label('peso' , 'Peso: '.$exam->peso) !!}
                                    <br>
                                    {!!  Form::label('piel' , 'Piel: '.$exam->piel) !!}
                                    <br>
                                    {!!  Form::label('anomaliaForma' , 'Anomalía en forma: '.$exam->anomaliaForma) !!}
                                    <br>
                                    {!!  Form::label('anomaliaTamaño' , 'Anomalía en tamaño: '.$exam->anomaliaTamaño) !!}
                                    <br>
                                    @if($exam->otros!=null)
                                        {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
                                    @else
                                        {!! "N/D" !!}
                                    @endif
                                </div>

                            </div>
                        </div>
                    @elseif($exam->tipoExam=='periodoncial')
                        <br>
                        <div class="card">
                            <div class="card-header"><h5>Examen Periodontal</h5></div>
                            <div class="card-body">
                                <div>
                                    {!!  Form::label('indicePlaca' , 'Índice de placa: '.$exam->indicePlaca) !!}
                                    <br>
                                    {!!  Form::label('color' , 'Color: '.$exam->color) !!}
                                    <br>
                                    {!!  Form::label('borde' , 'Borde: '.$exam->borde) !!}
                                    <br>
                                    {!!  Form::label('aspecto' , 'Aspecto: '.$exam->aspecto) !!}
                                    <br>
                                    {!!  Form::label('consistencia' , 'Consistencia: '.$exam->consistencia) !!}
                                    <br>
                                    {!!  Form::label('biotipo' , 'Biotipo: '.$exam->biotipo) !!}
                                    <br>
                                    @if($exam->otros!=null)
                                        {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
                                    @else
                                        {!! "N/D" !!}
                                    @endif                                </div>

                            </div>
                        </div>
                    <br>
                    <div class="card">
                        <div class="card-header"><h5>Estudio dental</h5></div>
                        <div class="card-body">
                            <div class="title m-b-md" style="text-align: center">
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
                                </tr>
                                @foreach ($asociacion_exam_dientes as $asociacion_exam_diente)
                                    <tr style="word-break: break-word;">
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

                                    </tr>
                                @endforeach
                            </table>
                            {{$asociacion_exam_dientes->render()}}
                            @if(sizeof($asociacion_exam_dientes)==0 && \Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                {!! Form::open(['route' => ['create_asociacionEDPeriodoncia',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Realizar examen dental', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['edit_asociacionEDPeriodoncia',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>

                    @elseif($exam->tipoExam=='ortodoncial')
                        <br>
                        <div class="card">
                            <div class="card-header"><h5>Examen Ortodoncia</h5></div>
                            <div class="card-body">
                                <div>
                                    {!!  Form::label('patronFacial' , 'Patrón Facial: '.$exam->patronFacial) !!}
                                    <br>
                                    {!!  Form::label('perfil' , 'Perfil: '.$exam->perfil) !!}
                                    <br>
                                    {!!  Form::label('menton' , 'Mentón: '.$exam->menton) !!}
                                    <br>
                                    {!!  Form::label('aspecto' , 'Aspecto: '.$exam->aspecto) !!}
                                    <br>
                                    @if($exam->otros!=null)
                                        {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
                                    @else
                                        {!! "N/D" !!}
                                    @endif                                </div>

                            </div>
                        </div>
                    @elseif($exam->tipoExam=='evOrto')
                    <br>
                        <div class="card">
                            <div class="card-header"><h5>Evaluación ortodoncia</h5></div>
                            <div class="card-body">
                                <div>
                                    {!!  Form::label('previsto' , 'Previsto: '.$exam->previsto) !!}
                                    <br>
                                    {!!  Form::label('maxilar' , 'Maxilar: '.$exam->maxilar) !!}
                                    <br>
                                    {!!  Form::label('mandibular' , 'Mandibular: '.$exam->mandibular) !!}
                                    <br>
                                    {!!  Form::label('logrado' , 'Logrado: '.$exam->logrado) !!}
                                    <br>
                                    @if($exam->otros!=null)
                                        {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
                                    @else
                                        {!! "N/D" !!}
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endif
<br>

                    <div class="card" >
                        <div class="card-header"><h5>Diagnósticos</h5></div>
                        <div class="card-body">
                            @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                            {!! Form::open(['route' => ['asociacion_ExDiags.create',$exam->id], 'method' => 'get']) !!}
                            {!!   Form::submit('Añadir diagnóstico', ['class'=> 'btn btn-primary button-align'])!!}
                            {!! Form::close() !!}
                            <br><br>
                            @endif
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Nombre</th>
                            <th>Comentario</th>
                            @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')
                                <th colspan="3">Acciones</th>
                            @endif
                        </tr>

                        @foreach ($diagnosticos as $diagnostico)
                            <tr>
                                <td style=" min-width: 300px;">{{ $diagnostico->nombre }}</td>
                                @if($diagnostico->pivot->comentario!=null)
                                    <td  style="word-wrap: break-word !important;max-width: 500px;">{{ $diagnostico->pivot->comentario }}</td>
                                @else
                                    <td  style="word-wrap: break-word !important;max-width: 500px;">{!! "N/D" !!}</td>
                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')

                                <td>

                                    {!! Form::open(['route' => ['asociacion_ExDiags.destroy',$diagnostico->id], 'method' => 'delete']) !!}
                                    {!! Form::hidden('exam_id',$exam->id) !!}
                                    {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                                {{$diagnosticos->render()}}

                        </div>
                    </div>

            <br>
                <div class="card" >
                    <div class="card-header"><h5>Tratamientos</h5></div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')

                        {!! Form::open(['route' => ['tratamientos.createT',$exam->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Añadir tratamiento', ['class'=> 'btn btn-primary  button-align'])!!}
                        {!! Form::close() !!}
                        @endif
                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Coste (€)</th>
                                <th>IVA (%)</th>
                                <th>Terapia</th>
                                <th>Zona</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                @if($exam->tipoExam=='ortodoncial')
                                    <th>Brakets</th>
                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                <th colspan="2">Acciones</th>
                                @endif
                            </tr>

                            @foreach ($tratamientos as $tratamiento)
                                <tr>
                                    <td style="word-wrap: break-word;max-width: 254px;">{{ $tratamiento->tipoTratamiento->name }}</td>
                                    <td>{{ $tratamiento->coste }}</td>
                                    <td>{{$tratamiento->iva}}</td>
                                    <td>{{ $tratamiento->terapia }}</td>
                                    <td>@if($tratamiento->asociacion_exam_diente_id!=null)
                                            {{'Diente '.$tratamiento->asociacion_exam_diente->diente->number}}
                                        @else
                                            {{'Bucal'}}
                                        @endif
                                    </td>
                                    @if($tratamiento->fecha_inicio!=null)
                                    <td>{{ \Carbon\Carbon::parse($tratamiento->fecha_inicio)->format('d-m-Y')  }}</td>
                                    @else
                                        <td>{{"N/D"}}</td>
                                    @endif
                                    @if($tratamiento->fecha_fin!=null)
                                    <td>{{ \Carbon\Carbon::parse($tratamiento->fecha_fin)->format('d-m-Y') }}</td>
                                    @else
                                        <td>{{"N/D"}}</td>
                                    @endif
                                    @if($exam->tipoExam=='ortodoncial')
                                    <td>{{ $tratamiento->braket->name}}</td>
                                    @endif
                                    <td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')

                                        {!! Form::open(['route' => ['tratamientos.edit',$tratamiento->id], 'method' => 'get','style'=>'display:inline-block']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    @endif

                                    @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')

                                        {!! Form::open(['route' => ['tratamientos.destroy',$tratamiento->id], 'method' => 'delete','style'=>'display:inline-block']) !!}
                                        {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}

                                    @endif
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <th>Coste total (€): </th>
                                <th>{{$coste_total}}</th>
                            </tr>
                            <tr>
                                <th>Cobrado:
                                    @if($coste_total!='0' && $exam->cobrado==0 && \Illuminate\Support\Facades\Auth::user()->userType!='student')
                                            {!! Form::open(['route'=> ['correo_pago',$exam->id], 'method'=>'get']) !!}
                                            {!!   Form::submit('Pagar con PAYPAL', ['class'=> 'btn btn-outline-dark' ])!!}
                                            {!! Form::close() !!}
                                            <br>
                                            {!! Form::open(['route'=> ['pagado',$exam->id], 'method'=>'get']) !!}
                                            {!!   Form::submit('Pagado', ['class'=> 'btn btn-warning' ])!!}
                                            {!! Form::close() !!}
                                    @elseif($coste_total!='0' && $exam->cobrado==1 && \Illuminate\Support\Facades\Auth::user()->userType!='student')
                                        {!! Form::open(['route'=> ['no_pagado',$exam->id], 'method'=>'get']) !!}
                                        {!!   Form::submit('No pagado', ['class'=> 'btn btn-warning' ])!!}
                                        {!! Form::close() !!}
                                    @endif
                                </th>
                                @if( $exam->cobrado==1)
                                    <td>{{'Si'}}</td>
                                @else
                                    <td><b><FONT COLOR="red">{{'No'}}</FONT></b></td>
                                @endif                            </tr>
                        </table>
                            {{$tratamientos->render()}}

                    </div>
                </div>

                <br>
                <div class="card" >
                    <div class="card-header"><h5>Pruebas complementarias</h5></div>
                       <div class="card-body">
                           @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')

                           {!! Form::open(['route' => ['prueba_complementarias.createT',$exam->id], 'method' => 'get']) !!}
                            {!!   Form::submit('Añadir prueba complementaria', ['class'=> 'btn btn-primary  button-align'])!!}
                            {!! Form::close() !!}
                           <br><br>
                           @endif
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th style="width:200px">Fichero</th>
                                <th style="width:300px">Comentario</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                    <th colspan="2">Acciones</th>
                                @endif
                            </tr>

                            @foreach ($prueba_complementarias as $prueba_complementaria)
                                <tr>
                                    <td style="word-break:break-word; width: 300px;">{{ $prueba_complementaria->nombre }}</td>
                                    <td width="120px">
                                    <div class="text-center"><a target="_blank" href="/{{$prueba_complementaria->fichero}}">
                                            <img src="/pdf.png" height="35px"/></a></div></td>
                                    @if($prueba_complementaria->comentario!=null)
                                        <td style="word-wrap: break-word;max-width: 300px;">{{ $prueba_complementaria->comentario }}</td>
                                    @else
                                        <td>{{"N/D"}}</td>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')

                                    <td style="width: 106px;"> {!! Form::open(['route' => ['prueba_complementarias.edit',$prueba_complementaria->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}</td>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')
                                        <td style="width: 106px;">
                                        {!! Form::open(['route' => ['prueba_complementarias.destroy',$prueba_complementaria->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                               {{$prueba_complementarias->render()}}

                       </div>
                </div>


                        <div class="card-body">

                            @if($exam->tipoExam=='ortodoncial')
                                    {!! Form::open(['route' => ['exams.evaluaciones',$exam->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Mostrar evaluaciones', ['class'=> 'btn btn-primary button-align'])!!}
                                    {!! Form::close() !!}


                            @endif


                            @if(Auth::user()->userType =='teacher'&& $exam->tipoExam!='otro')
                                {!! Form::open(['route' => ['examsEditTeacher',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Editar', ['class'=> 'btn btn-warning button-align'])!!}
                                {!! Form::close() !!}

                            @endif
                            @if(Auth::user()->userType =='student' && $exam->tipoExam!='otro')
                                {!! Form::open(['route' => ['exams.edit',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Editar', ['class'=> 'btn btn-warning button-align'])!!}
                                {!! Form::close() !!}

                            @endif

                            @if(Auth::user()->userType =='teacher')
                                {!! Form::open(['route' => ['examsdeleteTeacher',$exam->id], 'method' => 'delete']) !!}
                                {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger button-align' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                {!! Form::close() !!}
                            @endif
                                {!! Form::open(['route' => ['imprimir_examen',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Generar PDF', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}


                                {!! Form::open(['route' => ['patients.show',$exam->patient_id], 'method' => 'get']) !!}
                                {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                                {!! Form::close() !!}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
