@extends('admin.layouts.admin_layout')

@section('title', 'Nuevo Post')

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
            <li class="active">Nuevo Post</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Nuevo Post
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => 'posts.store', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) !!}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        Hubo errores en los datos. Por favor intente nuevamente.
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="product_name"> Titulo </label>
                    <div class="col-sm-9">
                        <input type="text" name="title" id="title" placeholder="Titulo"
                               class="col-xs-10 col-sm-5" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="content">Descripcion </label>

                    <div class="col-sm-9">
                        <textarea name="description" id="description"
                                  class="autosize-transition form-control" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="content">
                        Contenido </label>

                    <div class="col-sm-9">
                        <textarea name="content" id="content"
                                  class="autosize-transition form-control" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="photo"> Foto </label>
                    <div class="col-sm-9">
                        <input type="file" id="photo" name="photo" required/>
                    </div>
                </div>


                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Guardar
                        </button>
                        <button class="btn btn-info" type="button" id="save_and_new">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Guardar y crear nuevo
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
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });
        }

        $(document).ready(function() {
            @if (isset($message) && isset($status))
                 notification('{{ $status }}', '{{ $message }}');
            @endif

            $("#save_and_new").click(function () {
                var form = $('#save_and_new').parentsUntil('form').parent()[0];
                var action = $(form).attr('action');
                $(form).attr('action', action + "?new=true");
                $(form).submit();
            });
        });
    </script>
@endsection