<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        h2{
            text-align: center;
            text-transform: uppercase;
        }
        .contenido{
            font-size: 20px;
        }
        #primero{
            background-color: #ccc;
        }
        #segundo{
            color:#44a359;
        }
        #tercero{
            text-decoration:line-through;
        }
    </style>
</head>
<table align="center">
    <tr>
        <td>
            <img  src={{ asset('/logotipo_f_odontologia.png') }} title="logotipo_facultad_odontologia_us" alt="Facultad Odontología US" height="100">
        </td>
        <td>
            <h2>Área clínica facultad de odontología</h2>
        </td>
        <td>
            <img height="80" src={{ asset('/Emblema_Universidad_de_Sevilla.png') }} title="emblema_us" alt="Emblema US" >
        </td>
    </tr>
</table>
<hr>
<body>
<div class="contenido">
    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Nombre:</td>
            <td bgcolor="#CCCCCC">Fecha de examen:</td>
            <td bgcolor="#CCCCCC">Tipo de examen:</td>

        </tr>
        <tr>
            <td>{!! Form::label( $exam->patient->name)." ".Form::label( $exam->patient->surname) !!}</td>
            <td>{!! Form::label($exam->date) !!}</td>
            <td>{!! Form::label($exam->tipoExam) !!}</td>
        </tr>
    </table>
    <br>
    @if($exam->tipoExam=='inicial')
    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Mucosas:</td>
        </tr>
        <tr>
            <td>
            <div>
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
            </td>
        </tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Índice Periodontitis comunitario(IPC):</td>
        </tr>
        <tr>
            <td>

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
            </td>
        </tr>
    </table>
    <br>
    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Anomalías dentofaciales:</td>
        </tr>
        <tr>
            <td>
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
            </td>
        </tr>
    </table>
    <br>
    @elseif($exam->tipoExam=='infantil')
    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Examen infantil:</td>
        </tr>
        <tr>
            <td>
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
            </td>
        </tr>
    </table>
    <br>
    @elseif($exam->tipoExam=='periodoncial')
    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Examen Periodontal:</td>
        </tr>
        <tr>
            <td>

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


            </td>
        </tr>
    </table>
    <br>
    @elseif($exam->tipoExam=='ortodoncial')

    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Examen Ortodoncia:</td>
        </tr>
        <tr>
            <td>

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


            </td>
        </tr>
    </table>
    <br>
    @elseif($exam->tipoExam=='evOrto')

    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Evaluación ortodoncia:</td>
        </tr>
        <tr>
            <td>

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


            </td>
        </tr>
    </table>
    <br>
    @endif

    <body>Diagnósticos:</body>

    <table border="1" width="100%">
        <tr>
            <th bgcolor="#CCCCCC">Nombre</th>
        </tr>

        @foreach ($diagnosticos as $diagnostico)
            <tr>
                <td>{{ $diagnostico->nombre }}</td>
            </tr>
        @endforeach
    </table>


    <body>Tratamientos:</body>

    <table border="1" width="100%">
        <tr>
            <td bgcolor="#CCCCCC">Nombre</td>
            <td bgcolor="#CCCCCC">Coste</td>
            <td bgcolor="#CCCCCC">Iva</td>
            <td bgcolor="#CCCCCC">Cobrado</td>
            <td bgcolor="#CCCCCC">Terapia</td>
            <td bgcolor="#CCCCCC">Fecha inicio</td>
            <td bgcolor="#CCCCCC">Fecha fin</td>
            @if($exam->tipoExam=='ortodoncial')
                <td bgcolor="#CCCCCC">Brakets</td>
            @endif
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
                @if($exam->tipoExam=='ortodoncial')
                    <td>{{ $tratamiento->braket->name}}</td>
                @endif

            </tr>
        @endforeach
    </table>

    <br>
    <body>Pruebas complementarias:</body>

    <table border="1" width="100%">
        <tr>
            <td>Nombre</td>
            <td style="width:200px">Fichero</td>
            <td style="width:300px">Comentario</td>
        </tr>

        @foreach ($prueba_complementarias as $prueba_complementaria)
            <tr>
                <td bgcolor="#CCCCCC">{{ $prueba_complementaria->nombre }}</td>
                <td bgcolor="#CCCCCC">{{ $prueba_complementaria->fichero }}</td>
                <td bgcolor="#CCCCCC">{{ $prueba_complementaria->comentario }}</td>

            </tr>
        @endforeach
    </table>

</div>
</body>
</html>
