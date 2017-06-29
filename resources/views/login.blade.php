@extends('layouts.authentication.layout')

@section('title', 'Login')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">


                {!! Form::open(['route' => 'login_post', 'class' => 'form-signin']) !!}
                @if (isset($failed))
                    <div class="alert alert-danger">
                        Usuario o contraseña incorrecto.
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                @endif

                <h2 class="form-signin-heading">BIENVENIDO</h2>
                <label for="inputEmail" class="sr-only">Ingrese su email</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Ingrese su email" name="email" required autofocus>
                <label for="inputPassword" class="sr-only">Ingrese su contraseña</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Ingrese su contraseña" name="password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">INGRESAR</button>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> RECORDAR MI USUARIO Y CONTRASEÑA
                    </label>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row other-links-row">
            <div class="col-sm-12">
                <div class="other-links-container">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('recover') }}">OLVID&Eacute; MI CONTRASE&Ntilde;A</a>
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