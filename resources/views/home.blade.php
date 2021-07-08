@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('flash::message')
            <!--
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
            <br>
-->
                        @if(Auth::user()->userType =='student')

                    <div class="container" style="text-align: center">
                        <div class="row align-items-start">
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/patients/index')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Pacientes</strong>
                                                <img src="/patients.png"
                                                     width="60" height="60"
                                                     alt="Patients"

                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/perfiles/perfilstudent')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Perfil   </strong>
                                                <img src="/perfil.png"
                                                     width="60" height="60"
                                                     alt="Perfil"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                        @endif

                        @if(Auth::user()->userType =='teacher')

                    <div class="container" style="text-align: center">
                        <div class="row align-items-start">

                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/patients/indexteacher')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Pacientes</strong>
                                                <img src="/patients.png"
                                                     width="60" height="60"
                                                     alt="Patients"

                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/perfiles/perfilteacher')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Perfil</strong>
                                                <img src="/perfil.png"
                                                     width="60" height="60"
                                                     alt="Perfil"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/user/createT')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Registrar usuario</strong>
                                                <img src="/new_user.png"
                                                     width="60" height="60"
                                                     alt="Nuevo Usuario"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                        @endif

                        @if(Auth::user()->userType =='admin')
                    <div class="container" style="text-align: center">
                        <div class="row align-items-center">
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/user')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Usuarios</strong>
                                                <img src="/users.png"
                                                     width="60" height="60"
                                                     alt="Usuarios"

                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-striped table-bordered">

                                <tr>
                                    <td>
                                        <a href="{{url('/exams/indexExamsAdmin')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Exámenes</strong>
                                            <img src="/examen.png"
                                                 width="60" height="60"
                                                 alt="Examenes"

                                            />
                                        </a>
                                    </td>
                                </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/perfiladmin')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Perfil</strong>
                                                <img src="/perfil.png"
                                                     width="60" height="60"
                                                     alt="Perfil"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/tipo_tratamientos')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Tratamientos</strong>
                                                <img src="/tratamientos.png"
                                                     width="60" height="60"
                                                     alt="Tratamientos"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>
                                            <a href="{{url('/diagnosticos')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong>Diagnósticos</strong>
                                                <img src="/diagnostico.png"
                                                     width="60" height="60"
                                                     alt="Diagnosticos"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-striped table-bordered">
                                    <tr >
                                        <td >
                                            <a href="{{url('/brakets')}}" class="btn" style="box-shadow: 0px 0px 0px 0px grey;"><strong >Brackets</strong>
                                                <img src="/brackets.png"
                                                     width="60" height="60"
                                                     alt="Brackets"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

        </div>
    </div>
</div>
@endsection
