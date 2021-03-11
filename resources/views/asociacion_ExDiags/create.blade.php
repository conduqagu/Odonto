@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Diagnóstico</div>

                    <div class="card-body">
                        @include('flash::message')

                        {!! Form::open(['route' =>['asociacion_ExDiags.store',$exam_id],'method'=>'post']) !!}
                        <div class="form-group">
                            {!! Form::select('diagnostico_id', $diagnosticos, null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <br>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
