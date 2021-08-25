@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Examen Periodontal</h5></div>

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

                        {!! Form::model($exam, [ 'route' => ['examsUptadeTeacherPeriodontal',$exam->id],'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!!Form::label('patient_id', 'Paciente:  '.$exam->patient->name.' '.$exam->patient->surname) !!}
                            <br>
                        </div>
                        <div>
                            {!! Form::label('date', 'Fecha: ') !!}
                            {!! Form::label('date',\Carbon\Carbon::parse($exam->date)->format('d-m-Y')) !!}                        </div>
                        <div>
                            {!!  Form::label('indicePlaca' , 'Índice de placa: ') !!}
                            {!! Form::number('indicePlaca', null,['class' => 'form-control','max'=>"100",'min'=>'0','step'=>'0.01']) !!}
                        </div>
                        <div>
                            {!!  Form::label('color' , 'Color: *') !!}
                            {!! Form::select('color', array('rosa'=>'Rosa','rojo'=>'Rojo'),'rosa',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('borde' , 'Borde: *') !!}
                            {!! Form::select('borde', array('afilado'=>'Afilado','engrosado'=>'Engrosado'),'afilado',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('aspecto' , 'Aspecto: *') !!}
                            {!! Form::select('aspecto', array('puntillado'=>'Puntillado','liso'=>'Liso'),'liso',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('consistencia' , 'Consistencia: *') !!}
                            {!! Form::select('consistencia', array('firme'=>'Firme','depresible'=>'Depresible'),'firme',['class' => 'form-control', 'required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('biotipo' , 'Biotipo: *') !!}
                            {!! Form::select('biotipo',array('normal'=>'Normal','fino'=>'Fino','grueso'=>'Grueso'), 'normal',['class' => 'form-control','required']) !!}
                        </div>
                        <div>
                            {!!  Form::label('otros' , 'Otros: ') !!}
                            {!! Form::text('otros', null, ['class'=>'form-control','maxlength'=>"255"]) !!}
                            <br>
                        </div>

                        {!! Form::submit( 'Guardar',['class' => 'btn btn-primary', 'value' => 'finish'])!!}

                        {!! Form::close() !!}

                    </div>
                </div>
                <p>(*): Campos obligatorios</p>
            </div>
        </div>
    </div>
@endsection
