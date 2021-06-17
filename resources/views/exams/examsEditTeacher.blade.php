@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar examen de {{$exam->patient->name}} {{$exam->patient->surname}}</h5></h5></div>

                    <div class="card-body">
                        @include('flash::message')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::model($exam, [ 'route' => ['examsUpdateTeacher',$exam->id], 'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!!Form::label('patient_id', 'Paciente: '.$exam->patient->name) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('date', 'Fecha: '.$exam->date) !!}
                        </div>
                        @if($exam->tipoExam=='inicial')
                            <div>
                                {!!  Form::label('aspectoExtraoralNormal' , 'Aspecto Extraoral Normal') !!}
                                {!! Form::select('aspectoExtraoralNormal', array('1'=>'Si','0'=>'No'),$exam->aspectoExtraoralNormal,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('cancerOral' , 'Cancer Oral') !!}
                                {!! Form::select('cancerOral', array('1'=>'Si','0'=>'No'),$exam->cancerOral,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('anomaliasLabios' , 'Anomalias en labios') !!}
                                {!! Form::select('anomaliasLabios', array('1'=>'Si','0'=>'No'),$exam->anomaliasLabios,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('patologiaMucosa' , 'Patologías en mucosas') !!}
                                {!! Form::select('patologiaMucosa', array('Ninguna'=>'Ninguna','Tumor maligno'=>'Tumor maligno','leucoplasia'=>'leucoplasia','Liquen plano'=>'Liquen plano'),$exam->patologiaMucosa,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('fluorosis' , 'Fluorosis') !!}
                                {!! Form::select('fluorosis', array('Normal'=>'Normal','Discutible'=>'Discutible','Muy ligera'=>'Muy ligera','Ligera'=>'Ligera','Moderada'=>'Moderada','Intensa'=>'Intensa','Excluida'=>'Excluida','No registrada'=>'No registrada'),$exam->fluorosis,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('estadoS1' , 'Estado primer sextante') !!}
                                {!! Form::select('estadoS1', array('sano'=>'sano','hemorragia'=>'hemorragia','tártaro'=>'tártaro','bolsa 4-5 mm'=>'bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'excluido'),$exam->estadoS1,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('estadoS2' , 'Estado segundo sextante') !!}
                                {!! Form::select('estadoS2', array('sano'=>'sano','hemorragia'=>'hemorragia','tártaro'=>'tártaro','bolsa 4-5 mm'=>'bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'excluido'),$exam->estadoS2,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('estadoS3' , 'Estado tercer sextante') !!}
                                {!! Form::select('estadoS3', array('sano'=>'sano','hemorragia'=>'hemorragia','tártaro'=>'tártaro','bolsa 4-5 mm'=>'bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'excluido'),$exam->estadoS3,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('estadoS4' , 'Estado cuarto sextante') !!}
                                {!! Form::select('estadoS4', array('sano'=>'sano','hemorragia'=>'hemorragia','tártaro'=>'tártaro','bolsa 4-5 mm'=>'bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'excluido'),$exam->estadoS4,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('estadoS5' , 'Estado quinto sextante') !!}
                                {!! Form::select('estadoS5', array('sano'=>'sano','hemorragia'=>'hemorragia','tártaro'=>'tártaro','bolsa 4-5 mm'=>'bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'excluido'),$exam->estadoS5,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('estadoS6' , 'Estado sexto sextante') !!}
                                {!! Form::select('estadoS6', array('sano'=>'sano','hemorragia'=>'hemorragia','tártaro'=>'tártaro','bolsa 4-5 mm'=>'bolsa 4-5 mm', 'Bolsa de 6 mm o más'=>'Bolsa de 6 mm o más','excluido'=>'excluido'),$exam->estadoS6,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('claseAngle' , 'Angle') !!}
                                {!! Form::select('claseAngle', array('clase I'=>'clase I','clase II'=>'clase II','clase III'=>'clase III'),$exam->claseAngle,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('lateralAngle' , 'Lateral Angle') !!}
                                {!! Form::select('lateralAngle', array('Unilateral'=>'Unilateral','Bilateral'=>'Bilateral'),$exam->lateralAngle,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('tipoDentición' , 'Tipo Dentición') !!}
                                {!! Form::select('tipoDentición', array('Temporal'=>'Temporal','Mixta'=>'Mixta'),$exam->tipoDentición,['class' => 'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('apiñamientoIncisivoInferior' , 'Apiñamiento Incisivo Inferior') !!}
                                {!! Form::select('apiñamientoIncisivoInferior', array('1'=>'Si','0'=>'No'),$exam->apiñamientoIncisivoInferior,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('apiñamientoIncisivoSuperior' , 'Apiñamiento Incisivo Superior') !!}
                                {!! Form::select('apiñamientoIncisivoSuperior', array('1'=>'Si','0'=>'No'),$exam->apiñamientoIncisivoSuperior,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('perdidaEspacioAnterior' , 'Perdida Espacio Anterior') !!}
                                {!! Form::select('perdidaEspacioAnterior', array('1'=>'Si','0'=>'No'),$exam->perdidaEspacioAnterior,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('perdidaEspacioPosterior' , 'Perdida Espacio Posterior') !!}
                                {!! Form::select('perdidaEspacioPosterior', array('1'=>'Si','0'=>'No'),$exam->perdidaEspacioPosterior,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('mordidaCruzadaAnterior' , 'Mordida Cruzada Anterior') !!}
                                {!! Form::select('mordidaCruzadaAnterior', array('1'=>'Si','0'=>'No'),$exam->mordidaCruzadaAnterior,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('mordidaCruzadaPosterior' , 'Mordida Cruzada Posterior') !!}
                                {!! Form::select('mordidaCruzadaPosterior', array('1'=>'Si','0'=>'No'),$exam->mordidaCruzadaPosterior,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('desviacionLineaMedia' , 'Desviacion Linea Media') !!}
                                {!! Form::select('desviacionLineaMedia', array('1'=>'Si','0'=>'No'),$exam->desviacionLineaMedia,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('mordidaAbierta' , 'Mordida Abierta') !!}
                                {!! Form::select('mordidaAbierta', array('1'=>'Si','0'=>'No'),$exam->mordidaAbierta,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('habitos' , 'Hábitos') !!}
                                {!! Form::select('habitos', array('1'=>'Si','0'=>'No'),$exam->habitos,['class' => 'form-control', 'required']) !!}
                            </div>
                        @elseif($exam->tipoExam=='infantil')
                            <div>
                                {!!  Form::label('aspectoGeneral' , 'Aspecto General') !!}
                                {!! Form::text('aspectoGeneral',$exam->aspectoGeneral, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('talla' , 'Talla') !!}
                                {!! Form::text('talla',$exam->talla, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('peso' , 'Peso') !!}
                                {!! Form::text('peso',$exam->peso, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('piel' , 'Piel') !!}
                                {!! Form::text('piel',$exam->piel, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('anomaliaForma' , 'Anomalía en forma') !!}
                                {!! Form::text('anomaliaForma',$exam->anomaliaForma, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('anomaliaTamaño' , 'Anomalía en tamaño') !!}
                                {!! Form::text('anomaliaTamaño',$exam->anomaliaTamaño, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>

                        @elseif($exam->tipoExam=='periodoncial')
                            <div>
                                {!!  Form::label('indicePlaca' , 'Índice de placa') !!}
                                {!! Form::text('indicePlaca', $exam->indicePlaca,['class' => 'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('color' , 'Color') !!}
                                {!! Form::select('color', array('rosa'=>'Rosa','rojo'=>'Rojo'),$exam->color,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('borde' , 'Borde') !!}
                                {!! Form::select('borde', array('afilado'=>'Afilado','engrosado'=>'Engrosado'),$exam->borde,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('aspecto' , 'Aspecto') !!}
                                {!! Form::select('aspecto', array('puntillado'=>'Puntillado','liso'=>'Liso'),$exam->aspecto,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('consistencia' , 'Consistencia') !!}
                                {!! Form::select('consistencia', array('firme'=>'Firme','depresible'=>'Depresible'),$exam->consistencia,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div>
                                {!!  Form::label('biotipo' , 'Biotipo') !!}
                                {!! Form::number('biotipo', $exam->biotipo,['class' => 'form-control']) !!}
                            </div>


                        @elseif($exam->tipoExam='ortodoncial')
                            <div class="form-group">
                                {!!  Form::label('patronFacial' , 'Patrón Facial') !!}
                                {!! Form::select('patronFacial', array('dolicofacial'=>'Dolicofacial','mesofacial'=>'Mesofacial','braquifacial'=>'Braquifacial'),$exam->patronFacial,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!!  Form::label('perfil' , 'Perfil') !!}
                                {!! Form::select('perfil', array('armonico'=>'Armónico','convexo'=>'Convexo','concavo'=>'Concavo','plano'=>'Plano'),$exam->perfil,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!!  Form::label('menton' , 'Mentón') !!}
                                {!! Form::select('menton', array('marcado'=>'Marcado','normal'=>'Normal','retruido'=>'Retruido','plano'=>'Plano'),$exam->menton,['class' => 'form-control', 'required']) !!}
                            </div>

                        @elseif($exam->tipoExam='evOrto')
                            <div>
                                {!!  Form::label('orto_id' , 'Ortodoncia principal') !!}
                                {!! Form::select('orto_id',$ortodoncias, ['class'=>'form-control']) !!}
                            </div>
                            <div>
                                {!!  Form::label('previsto' , 'Previsto') !!}
                                {!! Form::text('previsto',$exam->previsto, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('maxilar' , 'Maxilar') !!}
                                {!! Form::text('maxilar',$exam->maxilar, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('mandibular' , 'Mandibular') !!}
                                {!! Form::text('mandibular',$exam->mandibular, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                            <div>
                                {!!  Form::label('logrado' , 'Logrado') !!}
                                {!! Form::text('logrado',$exam->logrado, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            </div>
                        @endif
                        <div>
                            {!!  Form::label('otros' , 'Otros') !!}
                            {!! Form::text('otros', $exam->otros, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            <br>
                        </div>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['exams.show',$exam->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
