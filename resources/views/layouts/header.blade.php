<div class="container-fluid top-bar px-md-5 px-3">
    <div class="row justify-content-center justify-content-md-between align-items-center py-4">
        <div class="col-md-auto col-12 pb-3 pb-md-0">
            <div class="cuadro-busqueda text-center text-md-left">
                <a href="{{ route('home') }}">
                    <img class="img-fluid" src="{{ asset('img/NutriciaActivaLogo.png') }}">
                </a>
            </div>
        </div>
        <div class="col-md-auto col-12">
            <div class="row text-center cuadro-busqueda" style="max-width: 230px;">
                <div class="col-12">
                    <h3>Bienvenido {{ Auth::user()->name }}</h3>
                </div>
                <div class="col-12">
                    <a href="{{ route('logout') }}" id="btn-salir">Salir</a>
                </div>
                <div class="col-12">
                    <form class="mt-2 form-search" action="{{ route('search') }}" method="get">
                        <label for="input" class="sr-only"> Buscador </label>
                        <input type="text" id="q" name="q" class="form-control" placeholder="Buscador" required>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>