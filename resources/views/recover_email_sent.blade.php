@extends('layouts.authentication.layout')

@section('title', 'Recuperar Password')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <form class="form-signin">
                    <h2 class="form-signin-heading">Recuperar contraseña</h2>
                    <h3 style="font-size: 1.3rem">Te hemos enviado un mail con instrucciones para resetear tu contraseña.</h3>
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