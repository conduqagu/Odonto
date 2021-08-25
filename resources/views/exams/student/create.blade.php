@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Examen nuevo</h5></div>

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
                        {!! Form::open(['route' => 'exams.store']) !!}
                        <div class="form-group">
                            {!!Form::label('patient', 'Paciente: '.$patient->name.' '.$patient->surname) !!}
                            {!! Form::hidden('patient_id',$patient->id) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('date', 'Fecha: *') !!}
                            {!! Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control','required','max'=>\Carbon\Carbon::now()->format("Y-m-d")]) !!}
                        </div>
                        <div class="form-group row">
                            <label for="examType" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de examen: *') }}</label>

                            <div class="col-md-6">
                                <input type="radio" id="inicial" name="tipoExam" value="inicial"  {{ (old('tipoExam')=='inicial')? "checked" : "" }}  class="@error('tipoExam') is-invalid @enderror" name="tipoExam" required autocomplete="tipoExam" autofocus>
                                <label for="inicial">Inicial</label><br>
                                <input type="radio" id="infantil" name="tipoExam" value="infantil" {{ (old('tipoExam')=='infantil')? "checked" : "" }} class="@error('tipoExam') is-invalid @enderror" name="tipoExam" required autocomplete="tipoExam" autofocus>
                                <label for="infantil">Infantil</label><br>
                                <input type="radio" id="ortodoncial" name="tipoExam" value="ortodoncial" {{ (old('tipoExam')=='ortodoncial')? "checked" : "" }} class="@error('tipoExam') is-invalid @enderror" name="tipoExam" required autocomplete="tipoExam" autofocus>
                                <label for="ortodoncia">Ortodoncia</label><br>
                                <input type="radio" id="periodoncial" name="tipoExam" value="periodoncial" {{ (old('tipoExam')=='periodoncial')? "checked" : "" }} class="@error('tipoExam') is-invalid @enderror" name="tipoExam" required autocomplete="tipoExam" autofocus>
                                <label for="perioconcia">Perioconcial</label><br>
                                <input type="radio" id="evOrto" name="tipoExam" value="evOrto" {{ (old('tipoExam')=='evOrto')? "checked" : "" }} class="@error('tipoExam') is-invalid @enderror" name="tipoExam" required autocomplete="tipoExam" autofocus>
                                <label for="evOrto">Evaluacion Ortodoncia</label><br>

                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('pin', 'Pin del profesor: *') !!}
                            <input id="pin" type="password" class="form-control " name="pin" value="{{ old('pin') }}"  name="pin" required>

                        </div>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['patients.show',$patient->id], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}

                </div>
            </div>
                <p>(*): Campos obligatorios</p>

            </div>
    </div>
@endsection
