<!-- Menu de navegacion con la imagen y el titulo de la seccion-->
<div class="container-fluid menu">
    <div class="row" style="min-height: 620px;">
        <div class="col-12 col-lg-6">
            <nav class="nav flex-md-row flex-column menu-superior">
                <a class="flex-sm-fill text-center nav-link {{ strpos(Route::currentRouteName(), 'course') !== false ? 'active' : '' }}" href="{{ route('courses') }}">MIS CURSOS</a>
                <a class="flex-sm-fill text-center nav-link {{ strpos(Route::currentRouteName(), 'product') !== false ? 'active' : '' }}" href="{{ route('product_categories') }}">PRODUCTOS</a>
                <a class="flex-sm-fill text-center nav-link" href="#contact-form">¿QU&Eacute; NECESITAS?</a>
            </nav>
        </div>
        @yield('outstanding_course')
        <div class="col-12 align-self-end">
            <h2 class="col-12 text-md-right text-center pb-4">
                @yield('title_header')
            </h2>
        </div>
    </div>
</div>
<style>
    .menu {
        overflow:hidden;
        background: linear-gradient(127deg, rgba(140,10,119,0.5) ,rgba(0,0,0,0) 50%)
        {{ strpos(Route::currentRouteName(), 'home') !== 0 ? ',url('.asset('img/naked-circle.png').') no-repeat' : '' }}
        ,url('@yield('menu_background_image')') no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>