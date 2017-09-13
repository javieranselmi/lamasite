@extends('admin.layouts.admin_layout')

@section('title', 'dashboard')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Dashboard</a>
            </li>

            <!--<li>
                <a href="#">Other Pages</a>
            </li>
            <li class="active">Blank Page</li>-->
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    @include('admin.widgets.course_state_by_user', ['users' => $users])
                    @include('admin.widgets.most_commented', ['resources' => $courses->sortByDesc('comments'), 'name' => "Cursos"])
                </div>
                <div class="row">
                    @include('admin.widgets.most_searched_words', ['most_searched' => $most_searched])
                    @include('admin.widgets.most_visited', ['resources' => $products->sortByDesc('visits'), 'name' => "Productos"])
                </div>
                <div class="row">
                    @include('admin.widgets.most_liked', ['resources' => $products->sortByDesc('likes'), 'name' => "Productos"])
                    @include('admin.widgets.most_shared', ['resources' => $products->sortByDesc('shares'), 'name' => "Productos"])
                </div>
                <div class="row">
                    @include('admin.widgets.most_liked', ['resources' => $posts->sortByDesc('likes'), 'name' => "Articulos"])
                    @include('admin.widgets.most_shared', ['resources' => $posts->sortByDesc('shares'), 'name' => "Articulos"])
                </div>
                <div class="row">
                    @include('admin.widgets.most_visited', ['resources' => $posts->sortByDesc('visits'), 'name' => "Articulos"])
                    @include('admin.widgets.most_commented', ['resources' => $posts->sortByDesc('comments'), 'name' => "Articulos"])
                </div>
                <div class="row">
                    @include('admin.widgets.most_downloaded', ['resources' => $files->sortByDesc('downloads')])
                    @include('admin.widgets.most_logged_users', ['user_login_metrics' => $user_login_metrics])
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection

@section("custom_script")
    <script type="text/javascript">
        $('.dialogs,.comments').ace_scroll({
            size: 300
        });
    </script>
@endsection