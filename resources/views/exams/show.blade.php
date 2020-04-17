@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalle de examen</div>

                    <div class="panel-body">

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fecha del examen</th>
                                <th>Aspecto Extraoral Normal</th>
                                <th>Presencia de cáncer oral</th>
                                <th>Anomalías en labios</th>
                                <th>Otros</th>
                                <th>Patología mucosa</th>
                                <th>Fluorosis</th>
                                <th>Estado sextante 1</th>
                                <th>Estado sextante 2</th>
                                <th>Estado sextante 3</th>
                                <th>Estado sextante 4</th>
                                <th>Estado sextante 5</th>
                                <th>Estado sextante 6</th>
                                <th>Angle</th>
                                <th>Lateral</th>
                                <th>Dentición</th>
                                <th>Apiñamiento Incisivo Inferior</th>
                                <th>Apiñamiento Incisivo Superior</th>
                                <th>Perdida Espacio Anterior</th>
                                <th>Perdida Espacio Posterior</th>
                                <th>Desviación Línea Media</th>
                                <th>Mordida Abierta</th>
                                <th>Hábitos</th>
                                <th>Paciente</th>

                            </tr>


                                <tr>
                                    <td>{{ $exam->date }}</td>
                                    <td>{{ $exam->aspectoExtraoralNormal }}</td>
                                    <td>{{ $exam->cancerOral }}</td>
                                    <td>{{ $exam->anomaliasLabios }}</td>
                                    <td>{{ $exam->otros }}</td>
                                    <td>{{ $exam->patologiaMucosa }}</td>
                                    <td>{{ $exam->fluorosis }}</td>
                                    <td>{{ $exam->estadoS1 }}</td>
                                    <td>{{ $exam->estadoS2 }}</td>
                                    <td>{{ $exam->estadoS3 }}</td>
                                    <td>{{ $exam->estadoS4 }}</td>
                                    <td>{{ $exam->estadoS5 }}</td>
                                    <td>{{ $exam->estadoS6 }}</td>
                                    <td>{{ $exam->claseAngle }}</td>
                                    <td>{{ $exam->lateralAngle }}</td>
                                    <td>{{ $exam->tipoDentición }}</td>
                                    <td>{{ $exam->apiñamientoIncisivoInferior }}</td>
                                    <td>{{ $exam->apiñamientoIncisivoSuperior }}</td>
                                    <td>{{ $exam->perdidaEspacioAnterior }}</td>
                                    <td>{{ $exam->perdidaEspacioPosterior }}</td>
                                    <td>{{ $exam->mordidaCruzadaAnterior }}</td>
                                    <td>{{ $exam->mordidaCruzadaPosterior }}</td>
                                    <td>{{ $exam->desviacionLineaMedia }}</td>
                                    <td>{{ $exam->mordidaAbierta }}</td>
                                    <td>{{ $exam->habitos }}</td>
                                    <td>{{ $exam->patient->name }}</td>

                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
