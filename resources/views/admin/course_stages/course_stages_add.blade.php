@extends('admin.layouts.admin_layout')

@section('title', 'Agregar Etapa de Curso')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/chosen.min.css') }}" />
@endsection

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Etapa de Cursos</a>
            </li>

            <li class="">
                <a href="#">Administrar Etapas</a>
            </li>
            <li class="active">Agregar</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Agregar Etapa
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => 'admin_course_stages_add_post', 'class' => 'form-horizontal', 'onsubmit' => 'return submitCourseStage()', 'role' => 'form', 'files' => true]) !!}
                    @if (isset($failed) || isset($iframe))
                        <div class="alert alert-danger" id="errors" style="{{ isset($iframe) ? 'display:none;' : '' }}">
                            Hubo errores en la creacion. Por favor intente nuevamente.
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_name"> Nombre </label>

                        <div class="col-sm-9">
                            <input type="text" name="course_stage_name" id="course_stage_name" placeholder="Nombre" class="col-xs-10 col-sm-5" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_description"> Descripcion </label>

                        <div class="col-sm-9">
                            <textarea name="course_stage_description" id="course_stage_description" class="autosize-transition form-control" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_duration_in_minutes"> Duracion en Minutos </label>

                        <div class="col-sm-9">
                            <input type="text" name="course_stage_duration_in_minutes" id="course_stage_duration_in_minutes" placeholder="Duracion Etapa en Minutos" class="col-xs-10 col-sm-5" required/>
                        </div>
                    </div>

                    @if(!isset($iframe))
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="course_stage_course_id"> Elegir curso </label>

                            <div class="col-sm-9">
                                <select class="chosen-select form-control" id="course_stage_course_id" name="course_stage_course_id" data-placeholder="Elegir Curso..." required>
                                    <option value="-1"></option>
                                    @foreach($courses as $course)
                                       <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="json" value="1" />
                    @endif

                    @if(isset($course_id))
                        <input type="hidden" name="course_stage_course_id" value="{{ $course_id }}" />
                    @endif

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_type"> Tipo Etapa </label>

                        <div class="col-sm-9">
                            <select class="chosen-select form-control" id="course_stage_type" name="course_stage_type" data-placeholder="Elegir Tipo..." required>
                                <option value=""></option>
                                <option value="html">HTML</option>
                                <option value="ppt">Presentacion</option>
                                <option value="vid_ppt">Presentacion con Video</option>
                                <option value="questionnaire">Multiple Choice</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="form-html" hidden>
                        <input type="hidden" name="course_stage_html" />
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_html"> HTML </label>
                        <div class="col-sm-9">
                            <div class="wysiwyg-editor" id="course_stage_html"></div>
                        </div>
                    </div>


                    <div class="form-group" id="form-video" hidden>
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_video"> Video Url</label>
                        <div class="col-sm-9">
                            <input type="text" id="course_stage_video" class="col-md-12" name="course_stage_video" />
                        </div>
                    </div>

                    <div class="form-group" id="form-ppt" hidden>
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_video"> Presentacion </label>
                        <div class="col-sm-9">
                            <input type="text" id="course_stage_ppt" class="col-md-12" name="course_stage_ppt" />
                        </div>
                    </div>

                    <div class="form-group course_stage_video_ppt_positions" id="form-json" hidden>
                        <span class="positions">
                            <label class="col-sm-3 control-label no-padding-right"> Diapositivas </label>
                            <div class="col-sm-9">
                                <input type="number" id="course_stage_video_position" name="course_stage_video_position[]" placeholder="Posicion Video en Segundos" class="col-xs-10 col-sm-5" />
                                <div class="col-sm-3">
                                    <input type="text" name="course_stage_slides[]" />
                                </div>
                                &nbsp;
                                <button type="button" data-toggle="tooltip" title="Agregar Cambio" id="add_ppt_change" class="btn btn-sm btn-success"><i class="icon-only ace-icon ace-icon fa fa-plus bigger-110"></i></button>
                            </div>
                        </span>
                    </div>

                    <div class="form-group" id="form-questionnaire" hidden>
                        <label class="col-sm-3 control-label no-padding-right" for="course_stage_questions"> Preguntas </label>

                        <div class="col-sm-9">
                            <select multiple="" name="course_stage_questions[]" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Elegir Preguntas...">
                                @foreach($questions as $question)
                                    <option value="{{ $question->id }}">{{ $question->title }}</option>
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
                            @if(!isset($iframe))
                                <button class="btn btn-info" type="button" id="save_and_new">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Guardar y crear nuevo
                                </button>
                            @endif
                        </div>
                    </div>
                {!! Form::close() !!}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection


@section('custom_script')
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('admin_assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
    </script>

    <script src="{{ asset('admin_assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.hotkeys.index.min.js') }}"></script>

    <script src="{{ asset('admin_assets/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/autosize.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/chosen.jquery.min.js') }}"></script>



    <script type="text/javascript">
        autosize($('textarea[class*=autosize]'));

        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect: true});

            $('.chosen-select').chosen().change(function(){
               switch ($(this).children('option:selected').val()){
                   case "html":
                       $("#form-html").show();
                       $("#form-video").hide();
                       $("#form-ppt").hide();
                       $("#form-json").hide();
                       $("#form-questionnaire").hide();

                       $("#form-video input").each(function(){$(this).prop('required',false)});
                       $("#form-ppt input").each(function(){$(this).prop('required',false)});
                       $("#form-json input").each(function(){$(this).prop('required',false)});
                       $("#form-questionnaire select").each(function(){$(this).prop('required',false)});
                       break;
                   case "ppt":
                       $("#form-html").hide();
                       $("#form-video").hide();
                       $("#form-ppt").show();
                       $("#form-json").hide();
                       $("#form-questionnaire").hide();

                       $("#form-video input").each(function(){$(this).prop('required',false)});
                       $("#form-ppt input").each(function(){$(this).prop('required',true)});
                       $("#form-json input").each(function(){$(this).prop('required',false)});
                       $("#form-questionnaire select").each(function(){$(this).prop('required',false)});
                       break;
                   case "vid_ppt":
                       $("#form-html").hide();
                       $("#form-video").show();
                       $("#form-ppt").hide();
                       $("#form-json").show();
                       $("#form-questionnaire").hide();

                       $("#form-video input").each(function(){$(this).prop('required',true)});
                       $("#form-ppt input").each(function(){$(this).prop('required',false)});
                       $("#form-json input").each(function(){$(this).prop('required',true)});
                       $("#form-questionnaire select").each(function(){$(this).prop('required',false)});
                       break;
                   case "questionnaire":
                       $("#form-html").hide();
                       $("#form-video").hide();
                       $("#form-ppt").hide();
                       $("#form-json").hide();
                       $("#form-questionnaire").show();

                       $("#form-video input").each(function(){$(this).prop('required',false)});
                       $("#form-ppt input").each(function(){$(this).prop('required',false)});
                       $("#form-json input").each(function(){$(this).prop('required',false)});
                       $("#form-questionnaire select").each(function(){$(this).prop('required',true)});
                       break;
               }
            });
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

        function submitCourseStage(){
            var stageType = $('#course_stage_type').children('option:selected').val();
            if(stageType == 'vid_ppt'){
                var previousVal = -1;
                var checked = true;
                $("[name='course_stage_video_position[]']").each(function(){
                    if(previousVal == -1) {
                        previousVal = parseInt($(this).val());
                        return true;
                    }

                    if(parseInt($(this).val()) < previousVal){
                        checked = false;
                        return false;
                    }
                    previousVal = parseInt($(this).val());
                });
                if(!checked){
                    alert('Las posiciones del video deben de ser ingresadas de menor a mayor.');
                    return false;
                }
            }else if(stageType == 'html'){
                var html_content = $('#course_stage_html').html();
                $('input[name=course_stage_html]').val(html_content);
                return true;
            }
        };

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

            @if(isset($iframe))
                $('form').submit(function(){
                //TODO: Fix this. On first submit, HTML is empty and blows up.
                $(this).ajaxSubmit({
                       dataType: 'json',
                       success: function(data){
                            if(data.status == 'success'){
                                parent.addCourseStage(data.course_stage);
                                parent.jQuery.fancybox.close();
                            }else{
                                $('#errors').show();
                            }
                       }
                    });
                    return false;
                });
            @endif

            $('[data-toggle="tooltip"]').tooltip();

            var quitarCambio = function(){
              $(this).parentsUntil('.positions').parent().remove();
            };

            $('#add_ppt_change').click(function() {
                var toAppend='\
                    <span class="positions">\
                        <label class="col-sm-3 control-label no-padding-right"></label>\
                        <div class="col-sm-9">\
                                <input type="text" id="course_stage_video_position" name="course_stage_video_position[]" placeholder="Posicion Video en Segundos" class="col-xs-10 col-sm-5" required />\
                                <div class="col-sm-3"> \
                                    <input type="text" name="course_stage_slides[]" required /> \
                                </div>\
                                &nbsp; \
                                <button type="button" data-toggle="tooltip" title="Quitar Cambio" class="btn btn-sm btn-danger remove_ppt_change"><i class="icon-only ace-icon ace-icon fa fa-minus bigger-110"></i></button>\
                        </div>\
                    </span>';
               $('.course_stage_video_ppt_positions').append(toAppend);
               $('[data-toggle="tooltip"]').tooltip();
               $('.remove_ppt_change').unbind('click');
               $('.remove_ppt_change').click(quitarCambio);
            });

            $('#course_stage_html').ace_wysiwyg({
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
        });
    </script>
@endsection