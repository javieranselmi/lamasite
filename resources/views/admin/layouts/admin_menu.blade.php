<ul class="nav nav-list">
    <li class="{{ Route::currentRouteName() == 'admin_dashboard' ? 'active' : '' }}">
        <a href="{{ route('admin_dashboard') }}">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> Dashboard </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'users') !== false ? 'active' : '' }}">
        <a href="{{ route('users.index') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Usuarios </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ (strpos(Route::currentRouteName(), 'product') !== false && strpos(Route::currentRouteName(), 'product_categories') === false && strpos(Route::currentRouteName(), 'product_subcategories') === false) ? 'active' : '' }}">
        <a href="{{ route('admin_products') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Productos </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'product_categories') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_product_categories') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Categorias Producto </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'product_subcategories') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_product_subcategories') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Subcategorias Producto </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ (strpos(Route::currentRouteName(), 'course') !== false && strpos(Route::currentRouteName(), 'course_stages') === false) ? 'active' : '' }}">
        <a href="{{ route('admin_courses') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Cursos </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'course_stages') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_course_stages') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Etapas de Cursos </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'question') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_questions') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Preguntas </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'posts') !== false ? 'active' : '' }}">
        <a href="{{ route('posts.index') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Biblioteca </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'events') !== false ? 'active' : '' }}">
        <a href="{{ route('events.index') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Eventos </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'contact') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_contact_edit') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Info Contacto </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'text') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_texts') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Textos </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'news') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_news_edit') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Novedad </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'meetings') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_meetings_categories_list') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Reuniones de Ciclo </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{ strpos(Route::currentRouteName(), 'notification_configuration') !== false ? 'active' : '' }}">
        <a href="{{ route('admin_notification_configuration_edit') }}">
            <i class="menu-icon fa fa-list"></i>
            <span class="menu-text"> Notificaciones </span>
        </a>

        <b class="arrow"></b>
    </li>


</ul><!-- /.nav-list -->