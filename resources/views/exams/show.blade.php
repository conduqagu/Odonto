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
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">Mucosas</div>
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
                    <div class="card-body">
                        <div class="card-header">Índice Periodontitis comunitario(IPC)</div>
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
                    <div class="card-body">
                    <div class="card-header">Anomalías dentofaciales</div>
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
                <div class="card-body">
                    {!! Form::open(['route' => ['exams.edit',$exam->id], 'method' => 'get']) !!}
                    {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                    {!! Form::close() !!}
               <br>
                    @if(Auth::user()->userType =='teacher')
                        {!! Form::open(['route' => ['indexasociacionEDTeacher',$exam->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                    @endif
                    @if(Auth::user()->userType =='student')
                        {!! Form::open(['route' => ['index_asociacionED',$exam->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Detalles examen dental', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                    @endif
                <br>
                    @if(Auth::user()->userType =='teacher')
                        {!! Form::open(['route' => ['examsIndexTeacher'], 'method' => 'get']) !!}
                        {!!   Form::submit('Todos los exámenes', ['class'=> 'btn btn-outline-dark'])!!}
                        {!! Form::close() !!}
                    @endif
                    @if(Auth::user()->userType =='student')
                        {!! Form::open(['route' => ['exams.index'], 'method' => 'get']) !!}
                        {!!   Form::submit('Todos los exámenes', ['class'=> 'btn btn-outline-dark'])!!}
                        {!! Form::close() !!}
                    @endif

                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
