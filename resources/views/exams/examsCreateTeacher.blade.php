@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Examen nuevo</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'examsStoreTeacher']) !!}
                        <div class="form-group">
                            <b>{!!  Form::label('paciente' , 'Paciente: '.$patient->name." ".$patient->surname) !!}
                            </b>
                            {!! Form::hidden('patient_id',$patient->id) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('date', 'Fecha') !!}
                            {!! Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group row">
                            <label for="examType" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de examen') }}</label>

                            <div class="col-md-6">
                                <input type="radio" id="inicial" name="tipoExam" value="inicial" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="inicial">Inicial</label><br>
                                @if($patient->child==1)
                                    <input type="radio" id="infantil" name="tipoExam" value="infantil" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                    <label for="infantil">Infantil</label><br>
                                @endif
                                <input type="radio" id="ortodoncial" name="tipoExam" value="ortodoncial" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="ortodoncial">Ortodoncia</label><br>
                                <input type="radio" id="periodoncial" name="tipoExam" value="periodoncial" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="periodoncia">Periodoncial</label><br>
                                <input type="radio" id="evOrto" name="tipoExam" value="evOrto" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="evOrto">Evaluacion Ortodoncia</label><br>
                                <input type="radio" id="otro" name="tipoExam" value="otro" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="otro">Otro</label><br>
                                @error('examType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                            {!! Form::submit('Continuar',['class'=>'btn-primary btn button-align']) !!}
                            {!! Form::close() !!}

                            <a class="btn btn-outline-dark button-align-right " style="margin-bottom: 15px" href="{{ url()->previous() }}">
                                Cancelar
                            </a>

                    </div>
                </div>
            </div>
        </div>
@endsection
