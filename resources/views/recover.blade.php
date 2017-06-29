@extends('layouts.authentication.layout')

@section('title', 'Recuperar Password')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">


                {!! Form::open(['route' => 'recover_post', 'class' => 'form-signin']) !!}
                @if (isset($failed))
                    <div class="alert alert-danger">
                        No tenemos registro de ese email.
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                @endif

                <h2 class="form-signin-heading">Recuperar contraseña</h2>
                <h3 style="font-size: 1.3rem">Por favor, ingrese su email. En breve recibir&aacute; por mail un link para generar una nueva contrase&ntilde;a.</h3>
                <label for="inputEmail" class="sr-only">Ingrese su email</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Ingrese su email" name="email" required autofocus>
                <button class="btn btn-lg btn-primary btn-block" type="submit">ENVIAR NUEVA CONTRASE&Ntilde;A</button>
                {!! Form::close() !!}
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