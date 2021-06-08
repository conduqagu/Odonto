@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('flash::message')

            <div class="card">
                <div class="card-header">{{ __('Bienvenido '.\Illuminate\Support\Facades\Auth::user()->name) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Sesión iniciada con éxito.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
