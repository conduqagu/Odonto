@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar diagnostico</h5></div>

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

                        {!! Form::model($tratamiento, [ 'route' => ['tratamientos.update',$tratamiento->id], 'method'=>'PUT']) !!}
                        @if($tratamiento->asociacion_exam_diente_id!=null)
                        <div class="form-group">
                            {!!  Form::label('asociacion_exam_diente_id' , 'Diente: '.$tratamiento->asociacion_exam_diente->diente->number) !!}
                        </div>
                        @endif
                        <div class="form-group">
                            {!!  Form::label('tipo_tratamiento_id' , 'Nombre') !!}
                            {!! Form::select('tipo_tratamiento_id', $tipo_tratamientos,$tratamiento->tipo_tratamiento_id,['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!!  Form::label('terapia' , 'Terapia') !!}
                            {!! Form::select('terapia', array('sin definir'=>'Sin definir','convencional'=>'Convencional','fases'=>'Fases'),$tratamiento->terapia,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fecha_inicio', 'Fecha inicio') !!}
                            {!! Form::date('fecha_inicio',$tratamiento->fecha_inicio,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fecha_fin', 'Fecha fin') !!}
                            {!! Form::date('fecha_fin',$tratamiento->fecha_fin,['class'=>'form-control']) !!}
                        </div>
                        @if(\App\Exam::find($tratamiento->exam_id)->tipoExam=='ortodoncial')
                            <div class="form-group">
                                {!!  Form::label('braket_id' , 'Brackets') !!}
                                {!! Form::select('braket_id', $brakets,null,['class' => 'form-control']) !!}
                            </div>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='student')
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
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['exams.show',$tratamiento->exam_id], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
