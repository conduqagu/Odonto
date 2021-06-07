@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar diagnostico</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::model($tratamiento, [ 'route' => ['tratamientos.update',$tratamiento->id], 'method'=>'PUT']) !!}
                        <div class="form-group">
                            {!!  Form::label('tipo_tratamiento_id' , 'Nombre') !!}
                            {!! Form::select('tipo_tratamiento_id', $tipo_tratamientos,$tratamiento->tipo_tratamiento_id,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('coste', 'Coste') !!}
                            {!! Form::number('coste',$tratamiento->coste,['class'=>'form-control', 'required','step'=>'0.01']) !!}
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
                                {!!  Form::label('braket_id' , 'Brakets') !!}
                                {!! Form::select('braket_id', $brakets,null,['class' => 'form-control']) !!}
                            </div>
                        @endif
                        <br>
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
