@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="title m-b-md">
                <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                    <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                </a>
            </div>
            <div >
                <div class="card">
                    <div class="card-header">Examen dental</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open( [ 'route' => ['store_asociacionED',$exam_id], 'method'=>'post']) !!}
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Numero Diente</th>
                                <th>Denticion Raiz</th>
                                <th>Denticion corona</th>
                                <th>Tratamiento</th>
                                <th>Opacidad</th>
                            </tr>
                            @foreach ($dientes as $diente)
                                <tr>
                                    <td>{!! Form::label('diente_id'.$diente->number,$diente->number) !!}{!! Form::hidden('diente_id'.$diente->number,$diente->id) !!}</td>
                                    <td>{!! Form::select('denticionRaiz'.$diente->number, array('Sano'=>'Sano','Cariado'=>'Cariado','Obturado sin caries'=>'Obturado sin caries',
                            'Pérdida otro motivo'=>'Pérdida otro motivo', 'Fisura Obturada'=>'Fisura Obturada','Pilar puente/corona'=>'Pilar puente/corona','Cariado'=>'Cariado',
                            'Diente no erupcionado'=>'Diente no erupcionado','Fractura'=>'Fractura'),'Sano',['id'=>$diente."denticionRaiz",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>
                                    <td>{!! Form::select('denticionCorona'.$diente->number, array('Sano'=>'Sano','Cariado'=>'Cariado','Obturado sin caries'=>'Obturado sin caries',
                            'Pérdida otro motivo'=>'Pérdida otro motivo', 'Fisura Obturada'=>'Fisura Obturada','Pilar puente/corona'=>'Pilar puente/corona','Cariado'=>'Cariado',
                            'Diente no erupcionado'=>'Diente no erupcionado','Fractura'=>'Fractura'),'Sano',['id'=>$diente."denticionCorona",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>
                                    <td>{!! Form::select('tratamiento'.$diente->number, array('Ninguno'=>'Ninguno','Preventivo'=>'Preventivo','Obturación de fisuras'=>'Obturación de fisuras',
                            'Obt. 1 o mas superficies'=>'Obt. 1 o mas superficies','Obt 2 o mas superficies'=>'Obt 2 o mas superficies','Corona'=>'Corona',
                            'Carilla estética'=>'Carilla estética','Tratamiento pulgar'=>'Tratamiento pulgar','Exodoncia'=>'Exodoncia','No registrado'=>'No registrado'),'Ninguno',
                            ['id'=>$diente."tratamiento",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>
                                    <td>{!! Form::select('opacidad'.$diente->number, array('Ningún estado anormal'=>'Ningún estado anormal','Opacidad delimitada'=>'Opacidad delimitada',
                            'OpacidadDifusa'=>'Opacidad Difusa','Hipoplasia'=>'Hipoplasia','Otros defectos'=>'Otros defectos',
                            'Opacidad elimitada y difusa'=>'Opacidad elimitada y difusa','Opacidad delimitada e hipoplasia'=>'Opacidad delimitada e hipoplasia',
                            'Opacidad difusa e hipoplasia'=>'Opacidad difusa e hipoplasia'),'Temporal',['id'=>$diente."opacidad",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>

                                </tr>
                            @endforeach
                        </table>

                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
