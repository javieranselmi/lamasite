@extends('admin.layouts.admin_layout')

@section('title', 'Editar Post')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/chosen.min.css') }}"/>
@endsection

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ route('posts.index') }}">Biblioteca</a>
            </li>
            <li class="active">Editar Post</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Editar Producto
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => ['users.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) !!}
                {{ method_field('PUT') }}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="content"> Nombre </label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" placeholder="Nombre" class="col-xs-10 col-sm-5"
                              value="{{ $user->name }}" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="content"> Email </label>
                    <div class="col-sm-9">
                        <input type="text" name="email" id="email" placeholder="Email" class="col-xs-10 col-sm-5"
                               value="{{ $user->email }}" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="content"> Contraseña </label>
                    <div class="col-sm-9">
                        <input type="password" name="password" id="password" placeholder="Contraseña"
                               value="{{ $user->password }}" class="col-xs-10 col-sm-5" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="content"> Confirmacion
                        Contraseña </label>
                    <div class="col-sm-9">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               placeholder="Repetir contraseña" value="{{ $user->password }}"  class="col-xs-10 col-sm-5" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="roles"> Rol </label>
                    <div class="col-sm-9">
                        <select class="chosen-select form-control" id="roles" name="roles" data-placeholder="Elegir rol..." required>
                            <option value="">  </option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if($role->id == $user->roles[0]->id)
                                            selected @endif>{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Guardar
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection


@section('custom_script')
    <script src="{{ asset('admin_assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/ace.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/autosize.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/chosen.jquery.min.js') }}"></script>

    <script type="text/javascript">
        autosize($('textarea[class*=autosize]'));

        $('#photo').ace_file_input({
            no_file: 'Sin Archivo ...',
            btn_choose: 'Elegir',
            btn_change: 'Cambiar',
            droppable: true,
            onchange: null,
            thumbnail: true,
            whitelist: 'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });

        if (!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect: true});
            //resize the chosen on window resize

            $(window)
                .off('resize.chosen')
                .on('resize.chosen', function () {
                    $('.chosen-select').each(function () {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                }).trigger('resize.chosen');
            $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });
        }
    </script>
@endsection