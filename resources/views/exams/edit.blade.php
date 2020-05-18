@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar diente</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($exam, [ 'route' => ['exams.update',$exam->id], 'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!! Form::label('date', 'Fecha') !!}
                            {!! Form::date('date',$exam->date,['class'=>'form-control', 'required']) !!}
                        </div>
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
                            {!!  Form::label('otros' , 'Otros') !!}
                            {!! Form::text('otros', $exam->otros, ['class'=>'form-control']) !!}
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
                        <div class="form-group">
                            {!!Form::label('patient_id', 'Paciente') !!}
                            <br>
                            {!! Form::select('patient_id', $patients,$exam->patient_id, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin del profesor') !!}
                            <input id="pin" type="password" class="awesome" name="pin" required>
                        </div>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
