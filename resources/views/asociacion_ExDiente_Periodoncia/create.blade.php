@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="title m-b-md">
                <a href="https://www.ilerna.es/blog/aprende-con-ilerna-online/sanidad/codigo-internacional-dientes-fdi">
                    <img src={{ asset('/asociacionED.png') }} height="450" title="Dentadura permanente-temporal" alt="Dentadura permanente-temporal"></a>
                </a>
            </div>

                <div class="card" style="width: max-content">
                    <div class="card-header"><h5>Examen dental</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open( [ 'route' => ['store_asociacionEDPeriodoncia',$exam_id], 'method'=>'post']) !!}
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
                            @foreach ($dientes as $diente)
                                <tr>
                                    <td>{!! Form::label('diente_id'.$diente->number,$diente->number) !!}
                                        {!! Form::hidden('diente_id'.$diente->number,$diente->id) !!}</td>
                                    <td>{!! Form::number('furca'.$diente->number,0) !!}</td>
                                    <td>{!! Form::number('retraccion'.$diente->number,0) !!}</td>
                                    <td>{!! Form::number('hipertrofia'.$diente->number,0) !!}</td>
                                    <td>{!! Form::select('sondaje'.$diente->number, array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::select('movilidad'.$diente->number, array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::select('sangrado'.$diente->number, array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}</td>
                                    <td>{!! Form::select('encia_insertada'.$diente->number, array('1'=>'Si','0'=>'No'),'0',['class' => 'form-control', 'required']) !!}</td>
                                </tr>
                            @endforeach
                        </table>
                        <br>
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

@endsection
