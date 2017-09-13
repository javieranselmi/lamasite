@extends('layouts.authentication.layout')

@section('title', 'Recuperar Contrase&ntilde;a')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">


                {!! Form::open(['route' => ['reset_password', $token], 'class' => 'form-signin']) !!}
                @if (isset($failed))
                    <div class="alert alert-danger">
                        {{ $error }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                @endif

                <h2 class="form-signin-heading">Cambiar contrase&ntilde;a</h2>
                <label for="inputPassword" class="sr-only">Ingrese su nueva contrase&ntilde;a</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Ingrese su nueva contrase&ntilde;a" name="password" required>
                <label for="inputPassword" class="sr-only">Confirme su nueva contrase&ntilde;a</label>
                <input type="password" id="inputPasswordConfirmation" class="form-control" placeholder="Confirme su nueva contrase&ntilde;a" name="password_confirmation" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">ENVIAR</button>
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

@section('custom_script')
    <script type="text/javascript">
        /*var password = document.getElementById("inputPassword"),
            confirm_password = document.getElementById("inputPasswordConfirmation");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Las contraseñas no coinciden.");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;*/
    </script>
@endsection