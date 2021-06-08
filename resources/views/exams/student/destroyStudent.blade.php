@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Eliminar examen de {{\App\Exam::find($id)->patient->name}} {{\App\Exam::find($id)->patient->surname}} del {{\App\Exam::find($id)->date}}</h5></div>

                    <div class="card-body">
                        @include('flash::message')
                        {!! Form::open(['route' => ['examsdeleteStudent',$id], 'method' => 'delete']) !!}

                            <div class="form-group">
                                {!! Form::label('pin', 'Pin del profesor') !!}
                                <input id="pin" type="password" class="awesome" name="pin" required>
                            </div>

                        {!! Form::submit('Eliminar',['class'=>'btn btn-danger button-align']) !!}
                        {!! Form::close() !!}

                        <a class="btn btn-outline-dark button-align-right " style="margin-bottom: 15px" href="{{ url()->previous() }}">
                            Cancelar
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
