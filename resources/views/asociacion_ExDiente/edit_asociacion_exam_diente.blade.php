@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="title m-b-md">
                <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                    <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                </a>
            </div>
            <div>
                <div class="card">
                    <div class="card-header"><h5>Examen dental</h5></div>

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
                        {!! Form::open( [ 'route' => ['update_asociacionED',$asociacion_exam_dientes->first()->exam_id], 'method'=>'put']) !!}

                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Numero Diente</th>
                                <th>Denticion Raiz</th>
                                <th>Denticion corona</th>
                                <th>Tratamiento</th>
                                <th>Opacidad</th>
                            </tr>
                            @foreach ($asociacion_exam_dientes as $a_e_d)

                            <tr>
                                    <td>{!! Form::label('diente_id'.$a_e_d->diente->number,$a_e_d->diente->number) !!}
                                        {!! Form::hidden('asociacion_exam_diente_id'.$a_e_d->diente->number,$a_e_d->id) !!}</td>
                                    <td>{!! Form::select('denticionRaiz'.$a_e_d->diente->number, array('Sano'=>'Sano','Cariado'=>'Cariado','Obturado sin caries'=>'Obturado sin caries',
                            'Pérdida otro motivo'=>'Pérdida otro motivo', 'Fisura Obturada'=>'Fisura Obturada','Pilar puente/corona'=>'Pilar puente/corona','Cariado'=>'Cariado',
                            'Diente no erupcionado'=>'Diente no erupcionado','Fractura'=>'Fractura'),$a_e_d->denticionRaiz,
                            ['id'=>$a_e_d->diente->number."denticionRaiz",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>
                                    <td>{!! Form::select('denticionCorona'.$a_e_d->diente->number, array('Sano'=>'Sano','Cariado'=>'Cariado','Obturado sin caries'=>'Obturado sin caries',
                            'Pérdida otro motivo'=>'Pérdida otro motivo', 'Fisura Obturada'=>'Fisura Obturada','Pilar puente/corona'=>'Pilar puente/corona','Cariado'=>'Cariado',
                            'Diente no erupcionado'=>'Diente no erupcionado','Fractura'=>'Fractura'),
                            $a_e_d->denticionCorona,['id'=>$a_e_d->diente->number."denticionCorona",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>
                                @if(\App\Tratamiento::where('asociacion_exam_diente_id','=',$a_e_d->id)->first()!=null)
                                        <td> {!! Form::select('tipo_tratamiento_id'.$a_e_d->diente->number, $tipo_tratamientos,
                                     \App\Tratamiento::where('asociacion_exam_diente_id','=',$a_e_d->id)->first()->tipoTratamiento->id
                                    ,['class' => 'form-control', 'required','style'=>"width: max-content"]) !!}</td>
                                @else
                                    <td> {!! Form::select('tipo_tratamiento_id'.$a_e_d->diente->number, $tipo_tratamientos,null,
                                    ['class' => 'form-control', 'required','style'=>"width: max-content"]) !!}</td>
                                @endif
                                    <td>{!! Form::select('opacidad'.$a_e_d->diente->number, array('Ningún estado anormal'=>'Ningún estado anormal','Opacidad delimitada'=>'Opacidad delimitada',
                            'OpacidadDifusa'=>'Opacidad Difusa','Hipoplasia'=>'Hipoplasia','Otros defectos'=>'Otros defectos',
                            'Opacidad elimitada y difusa'=>'Opacidad elimitada y difusa','Opacidad delimitada e hipoplasia'=>'Opacidad delimitada e hipoplasia',
                            'Opacidad difusa e hipoplasia'=>'Opacidad difusa e hipoplasia'),
                            $a_e_d->opacidad,['id'=>$a_e_d->diente->number."opacidad",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>
                                </tr>
                            @endforeach
                        </table>
                        @if (\Illuminate\Support\Facades\Auth::user()->userType=='student')
                            <div class="form-group">
                                {!! Form::label('pin', 'Pin del profesor') !!}
                                <input id="pin" type="password" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin') }}"  name="pin" required>
                                @error('pin')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                            {!! Form::open(['route' => ['exams.show',$asociacion_exam_dientes->first()->exam_id], 'method' => 'get']) !!}
                            {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                            {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
