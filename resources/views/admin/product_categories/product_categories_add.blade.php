@extends('admin.layouts.admin_layout')

@section('title', 'dashboard')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Categorias Producto</a>
            </li>

            <li class="">
                <a href="#">Administrar Categorias</a>
            </li>
            <li class="active">Agregar</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Agregar Categoria
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => 'admin_product_categories_add_post', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) !!}
                    @if (isset($failed))
                        <div class="alert alert-danger">
                            Hubo errores en la creacion. Por favor intente nuevamente.
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="category_name"> Nombre </label>

                        <div class="col-sm-9">
                            <input type="text" name="category_name" id="category_name" placeholder="Nombre" class="col-xs-10 col-sm-5" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="category_description"> Descripcion </label>

                        <div class="col-sm-9">
                            <textarea name="category_description" id="category_description" class="autosize-transition form-control" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="category_photo">URL Foto Categoria </label>
                        <div class="col-sm-9">
                            <input type="text" id="category_photo" name="category_photo" required />
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

    <script type="text/javascript">
        autosize($('textarea[class*=autosize]'));

        $(document).ready(function(){
            @if (isset($message) && isset($status))
                 notification('{{ $status }}', '{{ $message }}');
            @endif

            $("#save_and_new").click(function(){
                var form = $('#save_and_new').parentsUntil('form').parent()[0];
                var action = $(form).attr('action');
                $(form).attr('action', action + "?new=true");
                $(form).submit();
            });
        });
    </script>
@endsection