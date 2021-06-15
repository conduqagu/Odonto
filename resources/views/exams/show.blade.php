@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('flash::message')

                <div class="card">
                    <div class="card-header"><h5>Detalles del examen</h5></div>
                        <div class="card-body">
                            <div >
                                {!! Form::label('date', 'Fecha:') !!}
                                {!! Form::label($exam->date) !!}
                            </div>
                            <div class="form-group">
                                {!!Form::label('patient_id', 'Paciente: ') !!}
                                {!! Form::label( $exam->patient->name)." ".Form::label( $exam->patient->surname) !!}
                            </div>
                        </div>
                    </div>
                @if($exam->tipoExam=='inicial')

                <br>
                        <div class="card ">
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
                                    {!! Form::label( $exam->otros) !!}
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
                        <br>
                        <div class="card">
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
                            <br>
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
                                    {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
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
                                    {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
                                </div>

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
                                    {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
                                </div>

                            </div>
                        </div>
                    @elseif($exam->tipoExam=='evOrto')
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
                                    {!!  Form::label('otros' , 'Otros: '.$exam->otros) !!}
                                </div>

                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
    <br>
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <div class="card" >
                        <div class="card-header"><h5>Diagnósticos</h5></div>
                        <div class="card-body">
                            @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                            {!! Form::open(['route' => ['asociacion_ExDiags.create',$exam->id], 'method' => 'get']) !!}
                            {!!   Form::submit('Añadir diagnóstico', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                            <br>
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
                                <td  style="word-wrap: break-word !important;max-width: 500px;">{{ $diagnostico->pivot->comentario }}</td>
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
                    </div>
                    </div>

            <br>
                <div class="card" >
                    <div class="card-header"><h5>Tratamientos</h5></div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')

                        {!! Form::open(['route' => ['tratamientos.createT',$exam->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Añadir tratamiento', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                        @endif
                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Coste</th>
                                <th>IVA</th>
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
                                    <td>{{ $tratamiento->fecha_inicio }}</td>
                                    <td>{{ $tratamiento->fecha_fin }}</td>
                                    @if($exam->tipoExam=='ortodoncial')
                                    <td>{{ $tratamiento->braket->name}}</td>
                                    @endif

                                    @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                        <td>
                                        {!! Form::open(['route' => ['tratamientos.edit',$tratamiento->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}</td>
                                    @endif

                                    @if(\Illuminate\Support\Facades\Auth::user()->userType=='teacher')
                                        <td>
                                        {!! Form::open(['route' => ['tratamientos.destroy',$tratamiento->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Eliminar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                            <tr>
                                <th>Coste total (€): </th>
                                <th>{{$coste_total}}</th>
                            </tr>
                            <tr>
                                <th>Cobrado:
                                    @if($coste_total!='0' && $exam->cobrado==0)
                                            {!! Form::open(['route'=> ['correo_pago',$exam->id], 'method'=>'get']) !!}
                                            {!!   Form::submit('Pagar con PAYPAL', ['class'=> 'btn btn-outline-dark' ])!!}
                                            {!! Form::close() !!}
                                            <br>

                                            {!! Form::open(['route'=> ['pagado',$exam->id], 'method'=>'get']) !!}
                                            {!!   Form::submit('Pagado', ['class'=> 'btn btn-warning' ])!!}
                                            {!! Form::close() !!}
                                    @endif
                                </th>
                                @if( $exam->cobrado==1)
                                    <td>{{'Si'}}</td>
                                @else
                                    <td><b><FONT COLOR="red">{{'No'}}</FONT></b></td>
                                @endif                            </tr>
                        </table>
                    </div>
                </div>

                <br>
                <div class="card" >
                    <div class="card-header"><h5>Pruebas complementarias</h5></div>
                       <div class="card-body">
                           @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')

                           {!! Form::open(['route' => ['prueba_complementarias.createT',$exam->id], 'method' => 'get']) !!}
                            {!!   Form::submit('Añadir prueba complementaria', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                           <br>
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
                                    <td style="word-wrap: break-word;max-width: 300px;">{{ $prueba_complementaria->comentario }}</td>
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
                    </div>
                </div>

                        <div class="card-body">
                            @if($exam->tipoExam=='periodoncial')
                                @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                {!! Form::open(['route' => ['index_asociacionEDPeriodoncia',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                                @else
                                {!! Form::open(['route' => ['index_asociacionEDPeriodonciaA',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary button-align'])!!}
                                {!! Form::close() !!}
                                @endif
                            @elseif($exam->tipoExam=='inicial')
                                @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')
                                    {!! Form::open(['route' => ['index_asociacionED',$exam->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary button-align'])!!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['indexasociacionEDA',$exam->id], 'method' => 'get']) !!}
                                    {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary button-align'])!!}
                                    {!! Form::close() !!}
                                @endif

                            @elseif($exam->tipoExam=='ortodoncial')
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
                            @if(\Illuminate\Support\Facades\Auth::user()->userType!='admin')


                                {!! Form::open(['route' => ['exams.index',$exam->patient->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                                {!! Form::close() !!}
                            @else

                                {!! Form::open(['route' => ['indexExamsAdmin'], 'method' => 'get']) !!}
                                {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                                {!! Form::close() !!}
                            @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
