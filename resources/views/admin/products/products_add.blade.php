@extends('admin.layouts.admin_layout')

@section('title', 'Agregar Producto')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/chosen.min.css') }}" />
@endsection

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Productos</a>
            </li>

            <li class="">
                <a href="#">Administrar Productos</a>
            </li>
            <li class="active">Agregar</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Agregar Producto
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => 'admin_products_add_post', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) !!}
                    @if (isset($failed))
                        <div class="alert alert-danger">
                            Hubo errores en la creacion. Por favor intente nuevamente.
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_name"> Nombre </label>

                        <div class="col-sm-9">
                            <input type="text" name="product_name" id="product_name" placeholder="Nombre" class="col-xs-10 col-sm-5" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_category_id"> Categoria </label>

                        <div class="col-sm-9">
                            <select class="chosen-select form-control" id="product_category_id" name="product_category_id" data-placeholder="Elegir categoria..." required>
                                <option value="-1">  </option>
                                @foreach($product_categories as $product_category)
                                    <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_subcategory_id"> Subcategoria </label>

                        <div class="col-sm-9">
                            <select class="chosen-select form-control" id="product_subcategory_id" name="product_subcategory_id" data-placeholder="Elegir subcategoria..." required>
                                <option value="0" selected>Ninguno</option>
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="product_subtitle"> Subtitulo </label>

                    <div class="col-sm-9">
                        <textarea name="product_subtitle" id="product_subtitle" class="autosize-transition form-control" required></textarea>
                    </div>
                </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_description"> Descripcion </label>

                        <div class="col-sm-9">
                            <textarea name="product_description" id="product_description" class="autosize-transition form-control" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_components"> Componentes </label>
                        <div class="col-sm-9">
                            <textarea name="product_components" id="product_components">
                                @include('components.product_components_table_template')
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_photo"> Foto Producto </label>
                        <div class="col-sm-9">
<<<<<<< HEAD
                            <input type="text" id="product_photo" name="product_photo" required />
=======
                            <input type="file" id="product_photo" name="product_photo" required />
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_description"> Producto Destacado </label>

                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input name="product_featured" id="product_featured" type="checkbox" class="ace" value="1">
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="product_related_courses"> Cursos Relacionados </label>

                        <div class="col-sm-9">
                            <select multiple="" name="product_related_courses[]" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Elegir Cursos...">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

<<<<<<< HEAD
=======
                    <div class="form-group product_related_files" id="form-files">
                        <span class="files">
                            <label class="col-sm-3 control-label no-padding-right"> Archivos Relacionados </label>
                            <div class="col-sm-9">
                                <div class="col-sm-3">
                                    <input type="file" name="product_related_files[]" />
                                </div>
                                &nbsp;
                                <button type="button" data-toggle="tooltip" title="Agregar Archivo" id="add_ppt_change" class="btn btn-sm btn-success"><i class="icon-only ace-icon ace-icon fa fa-plus bigger-110"></i></button>
                            </div>
                        </span>
                    </div>

>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
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

    <script src="{{ asset('admin_assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.hotkeys.index.min.js') }}"></script>

    <script src="{{ asset('admin_assets/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        autosize($('textarea[class*=autosize]'));

<<<<<<< HEAD
=======
        $('#product_photo').ace_file_input({
            no_file:'Sin Archivo ...',
            btn_choose:'Elegir',
            btn_change:'Cambiar',
            droppable:true,
            onchange:null,
            thumbnail:true,
            whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });

>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
        if(!ace.vars['touch']) {
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

<<<<<<< HEAD
=======
            var relatedFileUploadParameters = {
                no_file:'Elegir Archivo ...',
                btn_choose:'Elegir',
                btn_change:'Cambiar',
                droppable:true,
                onchange:null,
                thumbnail:true,
                //whitelist:'jpg|png'
                blacklist:'exe|php|zip|rar'
                //onchange:''
                //
            };

            $("[name='product_related_files[]']").ace_file_input(relatedFileUploadParameters);

            var quitarArchivo = function(){
                $(this).parentsUntil('.files').parent().remove();
            };

            $('#add_ppt_change').click(function() {
                var toAppend='<span class="files"> \
                        <label class="col-sm-3 control-label no-padding-right"></label> \
                            <div class="col-sm-9"> \
                                <div class="col-sm-3"> \
                                    <input type="file" name="product_related_files[]" /> \
                                </div> \
                                &nbsp; \
                                <button type="button" data-toggle="tooltip" title="Quitar Archivo" class="btn btn-sm btn-danger remove_related_file"><i class="icon-only ace-icon ace-icon fa fa-minus bigger-110"></i></button> \
                            </div> \
                    </span>';
                $('.product_related_files').append(toAppend);
                $('[data-toggle="tooltip"]').tooltip();
                $('.remove_related_file').unbind('click');
                $('.remove_related_file').click(quitarArchivo);
                $("[name='product_related_files[]']").ace_file_input(relatedFileUploadParameters);
            });
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            CKEDITOR.replace( 'product_components', {language: 'es'});

            $('#product_category_id').change(function(){
                var select = $('#product_subcategory_id');
                $.get('{{ route('admin_product_subcategories_get_json') }}?category_id=' + this.value, function(data){
                   $(select).empty();
                    $(select).append($("<option></option>").attr("value", 0).text("Ninguno"));
                   $.each(data.subcategories, function(key, subcateg){
                       $(select).append($("<option></option>").attr("value", subcateg.id).text(subcateg.name));
                   });
                    $(select).trigger("chosen:updated");

                });
            });

        });
    </script>
@endsection