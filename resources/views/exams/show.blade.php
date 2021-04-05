@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detalles del examen</div>
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
                        <div class="card">
                            <div class="card-header">Mucosas</div>
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
                            <div class="card-header">Índice Periodontitis comunitario(IPC)</div>
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
                            <div class="card-header">Anomalías dentofaciales</div>
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
                    @elseif($exam->tipoExam=='infantil')
                        <br>
                        <div class="card">
                            <div class="card-header">Examen Infantil</div>
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
                            <div class="card-header">Examen Periodontal</div>
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
                            <div class="card-header">Examen Ortodoncia</div>
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
                            <div class="card-header">Evaluación ortodoncia</div>
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
                <br>
                    <div class="card">
                        <div class="card-header">Diagnósticos</div>
                        <div class="card-body">
                            {!! Form::open(['route' => ['asociacion_ExDiags.create',$exam->id], 'method' => 'get']) !!}
                            {!!   Form::submit('Añadir diagnóstico', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                            <br>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo diagnostico</th>
                            <th colspan="3">Acciones</th>
                        </tr>

                        @foreach ($diagnosticos as $diagnositico)
                            <tr>
                                <td>{{ $diagnositico->nombre }}</td>
                                <td>{{ $diagnositico->tipo_diagnostico_id}}</td>
                            </tr>
                        @endforeach
                    </table>
                    </div>
                    </div>

            <br>
                <div class="card">
                    <div class="card-header">Tratamientos</div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['tratamientos.createT',$exam->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Añadir tratamiento', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                        <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Coste</th>
                                <th>Iva</th>
                                <th>Cobrado</th>
                                <th>Terapia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Brakets</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($tratamientos as $tratamiento)
                                <tr>
                                    <td>{{ $tratamiento->tipoTratamiento->name }}</td>
                                    <td>{{ $tratamiento->coste }}</td>
                                    <td>{{ $tratamiento->iva }}</td>
                                    @if( $tratamiento->cobrado==1)
                                        <td>{{'Si'}}</td>
                                    @else
                                        <td><b><FONT COLOR="red">{{'No'}}</FONT></b></td>
                                    @endif
                                    <td>{{ $tratamiento->terapia }}</td>
                                    <td>{{ $tratamiento->fecha_inicio }}</td>
                                    <td>{{ $tratamiento->fecha_fin }}</td>
                                    <td>{{ $tratamiento->braket->name}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <br>
                <div class="card">
                    <div class="card-header">Pruebas complementarias</div>
                       <div class="card-body">
                            {!! Form::open(['route' => ['prueba_complementarias.createT',$exam->id], 'method' => 'get']) !!}
                            {!!   Form::submit('Añadir prueba complementaria', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                           <br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Fichero</th>
                                <th>Comentario</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($prueba_complementarias as $prueba_complementaria)
                                <tr>
                                    <td>{{ $prueba_complementaria->nombre }}</td>
                                    <td>{{ $prueba_complementaria->fichero }}</td>
                                    <td>{{ $prueba_complementaria->comentario }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>


                        <div class="card-body">
                            {!! Form::open(['route' => ['exams.edit',$exam->id], 'method' => 'get']) !!}
                            {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                            {!! Form::close() !!}
                       <br>
                            @if(Auth::user()->userType =='teacher'&&$exam->tipoExam=='inicial')
                                {!! Form::open(['route' => ['indexasociacionEDTeacher',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @endif
                            @if(Auth::user()->userType =='student'&&$exam->tipoExam=='inicial')
                                {!! Form::open(['route' => ['index_asociacionED',$exam->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary'])!!}
                                {!! Form::close() !!}
                            @endif
                        <br>

                                {!! Form::open(['route' => ['exams.index',$exam->patient->id], 'method' => 'get']) !!}
                                {!!   Form::submit('Todos los exámenes', ['class'=> 'btn btn-outline-dark'])!!}
                                {!! Form::close() !!}

                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
