@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Examen nuevo</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'exams.store']) !!}
                        <div class="form-group">
                            {!!Form::label('patient_id', 'Paciente') !!}
                            <br>
                            {!! Form::select('patient_id', $patients, ['class' => 'form-control', 'required']) !!}
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
                                <input type="radio" id="infantil" name="tipoExam" value="teacher" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="infantil">Infantil</label><br>
                                <input type="radio" id="ortodoncial" name="tipoExam" value="ortodoncia" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="ortodoncia">Ortodoncia</label><br>
                                <input type="radio" id="perioconcial" name="tipoExam" value="perioconcia" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="perioconcia">Perioconcial</label><br>
                                <input type="radio" id="evOrto" name="tipoExam" value="evaluacion" class="@error('tipoExam') is-invalid @enderror" name="tipoExam" value="{{ old('tipoExam') }}" required autocomplete="tipoExam" autofocus>
                                <label for="evaluacion">Evaluacion Ortodoncia</label><br>
                                @error('examType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin del profesor') !!}
                            <input id="pin" type="password" class="form-control" name="pin" required>
                        </div>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
