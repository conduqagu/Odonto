@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Editar prueba complementaria</h5></div>

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
                        {!! Form::model($prueba_complementaria, [ 'route' => ['prueba_complementarias.update',$prueba_complementaria->id],'enctype'=>"multipart/form-data",'files'=>'true', 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre: *') !!}
                            {!! Form::text('nombre',$prueba_complementaria->nombre,['class'=>'form-control', 'required','autofocus', 'maxlength'=>"255"]) !!}
                        </div>
                        <div class="row align-items-center">
                            <div class="col-3">
                                <label>Archivo actual:</label>
                                <div class="text-center"><a target="_blank" href="/{{$prueba_complementaria->fichero}}">
                                        <img src="/pdf.png" height="35px"/></a></div>
                            </div>
                            <div class="col">
                                <label>Modificar archivo:</label>
                                <br>
                                {!! Form::file('fichero',null,['class'=>'form-control', 'autofocus']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('comentario', 'Comentario: ') !!}
                            {!! Form::text('comentario',$prueba_complementaria->comentario,['class'=>'form-control', 'autofocus', 'maxlength'=>"255"]) !!}
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
                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn button-align']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['exams.show',$prueba_complementaria->exam_id], 'method' => 'get']) !!}
                        {!!   Form::submit('Volver', ['class'=> 'btn btn-outline-dark button-align-right'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <p>(*): Campos obligatorios</p>

            </div>
        </div>
    </div>
@endsection
