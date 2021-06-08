@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Diagnóstico</h5></div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' =>['asociacion_ExDiags.store',$exam_id],'method'=>'post']) !!}
                        <div class="form-group">
                            {!! Form::select('diagnostico_id', $diagnosticos, null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('comentario', 'Comentario') !!}
                            {!! Form::text('comentario',null,['class'=>'form-control', 'autofocus']) !!}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->userType=='student')
                            <div class="form-group">
                                {!! Form::label('pin', 'Pin del profesor') !!}
                                <input id="pin" type="password" class="form-control" name="pin" required>
                            </div>
                        @endif
                        <br>
                        {!! Form::submit( 'Guardar', ['class' => 'btn btn-primary button-align']) !!}
                        {!! Form::close() !!}

                        <a class="btn btn-outline-dark button-align-right " style="margin-bottom: 15px" href="{{ url()->previous() }}">
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
