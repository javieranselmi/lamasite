@extends('layouts.authentication.layout')

@section('title', 'Recuperar Password')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <form class="form-signin">
                    <h2 class="form-signin-heading">Su contraseña ha sido cambiada con exito.</h2>
                    <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block">INICIAR SESION</a>
                </form>
            </div>
        </div>
        <div class="row other-links-row">
            <div class="col-sm-12">
                <div class="other-links-container">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('login') }}">VOLVER A LOGIN</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="#">SOPORTE T&Eacute;CNICO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
@endsection