@extends('admin.layouts.admin_layout')

@section('title', 'Editar Texto')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/chosen.min.css') }}" />
@endsection

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Textos</a>
            </li>

            <li class="">
                <a href="#">Administrar Textos</a>
            </li>
            <li class="active">Texto</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Editar Texto
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => ['admin_texts_edit', $text->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}
                    @if (isset($failed))
                        <div class="alert alert-danger">
                            Hubo errores en la edicion. Por favor intente nuevamente.
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_name"> Nombre </label>

                        <div class="col-sm-9">
                            <input type="text" name="text_name" id="text_name" placeholder="Nombre" class="col-xs-10 col-sm-5" value="{{ $text->title }}" required readonly/>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="text_content" />
                        <label class="col-sm-3 control-label no-padding-right" for="text_name"> HTML </label>
                        <div class="col-sm-9">
                            <div class="wysiwyg-editor" id="text_content">{!! $text->content !!}</div>
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

    <script src="{{ asset('admin_assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.hotkeys.index.min.js') }}"></script>

    <script src="{{ asset('admin_assets/js/bootstrap-wysiwyg.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#text_content').ace_wysiwyg({
                toolbar:
                    [
                        'font',
                        null,
                        'fontSize',
                        null,
                        {name:'bold', className:'btn-info'},
                        {name:'italic', className:'btn-info'},
                        {name:'strikethrough', className:'btn-info'},
                        {name:'underline', className:'btn-info'},
                        null,
                        {name:'insertunorderedlist', className:'btn-success'},
                        {name:'insertorderedlist', className:'btn-success'},
                        {name:'outdent', className:'btn-purple'},
                        {name:'indent', className:'btn-purple'},
                        null,
                        {name:'justifyleft', className:'btn-primary'},
                        {name:'justifycenter', className:'btn-primary'},
                        {name:'justifyright', className:'btn-primary'},
                        {name:'justifyfull', className:'btn-inverse'},
                        null,
                        {name:'createLink', className:'btn-pink'},
                        {name:'unlink', className:'btn-pink'},
                        null,
                        null,
                        null,
                        'foreColor',
                        null,
                        {name:'undo', className:'btn-grey'},
                        {name:'redo', className:'btn-grey'}
                    ]
            }).prev().addClass('wysiwyg-style2');
            $('form').submit(function(){
                var html_content = $('#text_content').html();
                $('input[name=text_content]').val(html_content);
            });
        });
    </script>
@endsection