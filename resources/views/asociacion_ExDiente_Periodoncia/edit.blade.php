@extends('layouts.app')

@section('content')
    <div class="container2">
        <div class="row justify-content-center">
            <div class="col-md-10" style="text-align: center">
                <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                    <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                </a>
            </div>
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
                        {!! Form::open( [ 'route' => ['update_asociacionEDPeriodoncia',$asociacion_exam_dientes->first()->exam_id], 'method'=>'put']) !!}

                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Diente</th>
                                <th>Furca</th>
                                <th>Retraccion</th>
                                <th>Hipertrofia</th>
                                <th>Sondaje</th>
                                <th>Movilidad</th>
                                <th>Sangrado</th>
                                <th>Encía insertada</th>
                            </tr>
                            @foreach ($asociacion_exam_dientes as $a_e_d)
                                <tr>
                                    <td>{!! Form::label('diente_id'.$a_e_d->diente->number,$a_e_d->diente->number) !!}
                                        {!! Form::hidden('asociacion_exam_diente_id'.$a_e_d->diente->number,$a_e_d->id) !!}</td>
                                    <td>{!! Form::number('furca'.$a_e_d->diente->number,$a_e_d->furca) !!}</td>
                                    <td>{!! Form::number('retraccion'.$a_e_d->diente->number,$a_e_d->retraccion) !!}</td>
                                    <td>{!! Form::number('hipertrofia'.$a_e_d->diente->number,$a_e_d->hipertrofia) !!}</td>
                                    <td>{!! Form::select('sondaje'.$a_e_d->diente->number, array('1'=>'Si','0'=>'No'),$a_e_d->sondaje,['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::select('movilidad'.$a_e_d->diente->number, array('1'=>'Si','0'=>'No'),$a_e_d->movilidad,['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::select('sangrado'.$a_e_d->diente->number, array('1'=>'Si','0'=>'No'),$a_e_d->sangrado,['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::select('encia_insertada'.$a_e_d->diente->number, array('1'=>'Si','0'=>'No'),$a_e_d->encia_insertada,['class' => 'form-control', 'required']) !!}</td>
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
