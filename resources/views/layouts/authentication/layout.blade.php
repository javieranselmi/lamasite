<!DOCTYPE html>
<html class="full" lang="en">
<head>
    <title>NutriSite - @yield('title')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<div class="nav navbar-nav logo-nutri">
    <img class="img-fluid" src="{{ asset('img/NutriciaActivaLogo.png') }}" height="88" width="299">
</div>

@yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 text-muted">
                <h6>Desarrollado por FOUR Estrategia y Comunicacion</h6>
            </div>
            <div class="col-sm-4">
                <div class="float-right">
                    <img src="{{ asset('img/NutriciaActivaLogoFooter.png') }}" height="50">
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

@yield('custom_script')

</body>
</html>