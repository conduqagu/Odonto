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
                    <div class="card-header"><h5>Examen dental</h5></div>

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
                                    <td> {!! Form::select('tipo_tratamiento_id'.$diente->number, $tipo_tratamientos,null,['class' => 'form-control', 'required','style'=>"width: max-content"]) !!}</td>
                                    <td>{!! Form::select('opacidad'.$diente->number, array('Ningún estado anormal'=>'Ningún estado anormal','Opacidad delimitada'=>'Opacidad delimitada',
                            'OpacidadDifusa'=>'Opacidad Difusa','Hipoplasia'=>'Hipoplasia','Otros defectos'=>'Otros defectos',
                            'Opacidad elimitada y difusa'=>'Opacidad elimitada y difusa','Opacidad delimitada e hipoplasia'=>'Opacidad delimitada e hipoplasia',
                            'Opacidad difusa e hipoplasia'=>'Opacidad difusa e hipoplasia'),'Temporal',['id'=>$diente."opacidad",'class' => 'form-control', 'style'=>"width: max-content"]) !!}</td>

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
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
