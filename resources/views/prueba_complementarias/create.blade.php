@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Prueba complementaria</h5></div>

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
                        {!! Form::open(['route' => 'prueba_complementarias.store','enctype'=>"multipart/form-data",'files'=>'true']) !!}
                        <hidden>
                            {!! Form::hidden('exam_id', $exam_id) !!}
                        </hidden>
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre: *') !!}
                            {!! Form::text('nombre',null,['class'=>'form-control', 'required','autofocus', 'maxlength'=>"191"]) !!}
                        </div>
                        <div class="form-group">
                            <label>Nuevo Archivo: *</label>
                            <br>
                            {!! Form::file('fichero',null,['class'=>'form-control', 'required','autofocus']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('comentario', 'Comentario: ') !!}
                            {!! Form::text('comentario',null,['class'=>'form-control', 'autofocus', 'maxlength'=>"191"]) !!}
                        </div>

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
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['exams.show',$exam_id], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>(*): Campos obligatorios</p>

            </div>
        </div>

    </div>
    </div>
@endsection
