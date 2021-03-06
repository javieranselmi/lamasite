@extends('admin.layouts.admin_layout')

@section('title', 'Editar Curso')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-datetimepicker.min.css') }}"/>
@endsection

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Cursos</a>
            </li>

            <li class="">
                <a href="#">Administrar Cursos</a>
            </li>
            <li class="active">Editar</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Editar Curso
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => ['admin_courses_edit_post', $course->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) !!}
                    @if (isset($failed))
                        <div class="alert alert-danger">
                            Hubo errores en la edicion. Por favor intente nuevamente.
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_name"> Nombre </label>

                        <div class="col-sm-9">
                            <input type="text" name="course_name" id="course_name" placeholder="Nombre" class="col-xs-10 col-sm-5" value="{{ $course->name }}" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_description"> Descripcion </label>

                        <div class="col-sm-9">
                            <textarea name="course_description" id="course_description" class="autosize-transition form-control" required>{{ $course->description }}</textarea>
                        </div>
                    </div>

                <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_finish_date">
                            Fecha Limite </label>
                        <div class="col-sm-9">
                            <div class='input-group date' id='datetimepicker'>
                                <input type='text' id="course_finish_date" name="course_finish_date" class="form-control" value="{{ $course->finish_date }}"/>
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
<<<<<<< HEAD
                        <label class="col-sm-3 control-label no-padding-right" for="course_photo"> Foto Curso </label>
                        <div class="col-sm-9">
                            <img width="100px" src="{{ $course->file->file_name }}" /> <br/><br/>
                            <input type="text" name="course_photo" id="course_photo" placeholder="Url del sitio" class="col-xs-10 col-sm-5" value="{{ $course->file->file_name }}" required/>
=======
                        <label class="col-sm-3 control-label no-padding-right" for="course_photo"> URL de foto del curso </label>
                        <div class="col-sm-9">
                            <img width="100px" src="{{ $course->image_url }}" /> <br/><br/>
                            <input type="text" id="course_photo" name="course_photo" class="col-xs-10 col-sm-5"  value="{{ $course->image_url }}" required />
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="course_description"> Etapas </label>

                        <div class="col-sm-9">
                            <table id="course_stages" class="table table-striped table-bordered table-hover">
                                <thead>
                                </thead>

                                <tbody>
                                    @foreach($course->course_stages as $course_stage)
                                        <tr course_stage_id="{{ $course_stage->id }}">
                                            <td>{{ $course_stage->name }}</td>
                                            <td>
                                                @if($course_stage->type == 'html')
                                                    HTML
                                                @elseif($course_stage->type == 'ppt')
                                                    Presentacion
                                                @elseif($course_stage->type == 'vid_ppt')
                                                    Video con Presentacion
                                                @elseif($course_stage->type == 'questionnaire')
                                                    Questionario
                                                @endif
                                            </td>

                                            <td>
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <a class="blue" href="{{ route('course_stage', ['course_id' => $course->id, 'course_stage_id' => $course_stage->id]) }}" target="_blank">
                                                        <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                    </a>

                                                    <a class="green iframe-fancybox" href="{{ route("admin_course_stages_edit", ["course_stage_id" => $course_stage->id]) }}?iframe=true" data-fancybox-type="iframe">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>

                                                    <a class="red delete_course_stage" href="{{ route('admin_course_stages_delete', ['course_stage_id' => $course_stage->id]) }}">
                                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-3 col-md-9">
                                <a class="btn btn-success iframe-fancybox" href="{{ route('admin_course_stages_add') }}?iframe=true&course_id={{$course->id}}" data-fancybox-type="iframe">
                                    <i class="ace-icon fa fa-plus bigger-110"></i>
                                    Agregar Etapa
                                </a>
                            </div>
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
    <script src="{{ asset('admin_assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                sideBySide: true,
                format: 'YYYY-MM-DD HH:mm:ss',
                minDate: moment()
            });
        });
    </script>

    <script type="text/javascript">
        autosize($('textarea[class*=autosize]'));

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


        function editCourseStage(courseStage){
            var courseType = 'HTML';
            if(courseStage.type == 'ppt'){
                courseType = 'Presentacion'
            }else if(courseStage.type == 'vid_ppt'){
                courseType = 'Video con Presentacion'
            }else if(courseStage.type == 'questionnaire'){
                courseType = 'Questionario';
            }

            var courseStageRow = $('tr[course_stage_id='+courseStage.id+']');
            courseStageRow.children().eq(0).html(courseStage.name);
            courseStageRow.children().eq(1).html(courseType);

            notification('success', 'Etapa de curso editada');
        }

        function addCourseStage(courseStage){
            var courseType = 'HTML';
            if(courseStage.type == 'ppt'){
                courseType = 'Presentacion'
            }else if(courseStage.type == 'vid_ppt'){
                courseType = 'Video con Presentacion'
            }else if(courseStage.type == 'questionnaire'){
                courseType = 'Questionario';
            }

            var tbody = $('#course_stages tbody');
            var append = '<tr course_stage_id="'+courseStage.id+'"> \
                            <td>'+courseStage.name+'</td> \
                            <td>'+courseType+'</td> \
                            <td> \
                                <div class="hidden-sm hidden-xs action-buttons"> \
                                    <a class="blue" href="'+laroute.route('course_stage', {course_id: courseStage.course_id, course_stage_id: courseStage.id})+'" target="_blank"> \
                                        <i class="ace-icon fa fa-search-plus bigger-130"></i> \
                                    </a> \
                                    <a class="green iframe-fancybox" href="'+laroute.route('admin_course_stages_edit', {course_stage_id: courseStage.id})+'?iframe=true" data-fancybox-type="iframe"> \
                                        <i class="ace-icon fa fa-pencil bigger-130"></i> \
                                    </a> \
                                    <a class="red delete_course_stage" href="'+laroute.route('admin_course_stages_delete', {course_stage_id: courseStage.id})+'"> \
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i> \
                                    </a> \
                                </div> \
                            </td> \
                        </tr>';

            tbody.append(append);
            $('.delete_course_stage').unbind('click');
            $('.delete_course_stage').click(deleteResource);

            notification('success', 'Etapa de curso creada');
        }

        $(document).ready(function(){

            $(".iframe-fancybox").fancybox({
                maxWidth	: 1024,
                maxHeight	: 768,
                fitToView	: false,
                width		: '70%',
                height		: '70%',
                autoSize	: false,
                closeClick	: false,
                openEffect	: 'none',
                closeEffect	: 'none'
            });

            $('.delete_course_stage').click(deleteResource);
        });

    </script>
@endsection