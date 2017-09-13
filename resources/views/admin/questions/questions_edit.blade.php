@extends('admin.layouts.admin_layout')

@section('title', 'Editar Pregunta')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/chosen.min.css') }}" />
@endsection

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Preguntas</a>
            </li>

            <li class="">
                <a href="#">Administrar Preguntas</a>
            </li>
            <li class="active">Editar</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Editar Pregunta
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => ['admin_questions_edit_post', $question->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) !!}
                    @if (isset($failed))
                        <div class="alert alert-danger">
                            Hubo errores en la creacion. Por favor intente nuevamente.
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="question_title"> Pregunta </label>

                        <div class="col-sm-9">
                            <input type="text" name="question_title" id="question_title" placeholder="Pregunta" class="col-xs-10 col-sm-5" value="{{ $question->title }}" required/>
                        </div>
                    </div>

                <div class="form-group question_answers_div">
                    @foreach($question->answers as $index => $answer)
                        <span class="answers">
                            <label class="col-sm-3 control-label no-padding-right"> {{ $index == 0 ? "Respuestas" : "" }} </label>
                            <div class="col-sm-9">
                                <input type="text" id="question_answers" name="question_answers[]" placeholder="Respuesta" class="col-xs-10 col-sm-5" value="{{ $answer->content }}" required/>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input name="correct_answer[]" type="radio" class="ace" value="{{ $index }}" {{ $answer->is_correct ? "checked" : "" }} required>
                                            <span class="lbl"> Correcta</span>
                                        </label>
                                    </div>
                                </div>
                                &nbsp;
                                @if($index == 0)
                                    <button type="button" data-toggle="tooltip" title="Agregar Respuesta" id="add_answer" class="btn btn-sm btn-success"><i class="icon-only ace-icon ace-icon fa fa-plus bigger-110"></i></button>
                                @else
                                    <button type="button" data-toggle="tooltip" title="Quitar Respuesta" class="btn btn-sm btn-danger remove_answer"><i class="icon-only ace-icon ace-icon fa fa-minus bigger-110"></i></button>
                                @endif
                            </div>
                            <input type="hidden" name="answers_id[]" value="{{ $answer->id }}" />
                        </span>
                    @endforeach
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
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            var quitarRespuesta = function(){
                $(this).parentsUntil('.answers').parent().remove();
            };

            $("#add_answer").click(function(){
               var toAppend = '<span class="answers"> \
                                    <label class="col-sm-3 control-label no-padding-right"></label> \
                                    <div class="col-sm-9"> \
                                        <input type="text" id="question_answers" name="question_answers[]" placeholder="Respuesta" class="col-xs-10 col-sm-5" required/> \
                                        <div class="col-sm-3"> \
                                            <div class="radio"> \
                                                <label> \
                                                    <input name="correct_answer[]" type="radio" value="'+$(".answers").length+'" class="ace" required> \
                                                    <span class="lbl"> Correcta</span> \
                                                </label> \
                                            </div> \
                                        </div> \
                                        &nbsp; \
                                        <button type="button" data-toggle="tooltip" title="Quitar Respuesta" class="btn btn-sm btn-danger remove_answer"><i class="icon-only ace-icon ace-icon fa fa-minus bigger-110"></i></button>\
                                    </div> \
                                </span>';
                $('.question_answers_div').append(toAppend);
                $('[data-toggle="tooltip"]').tooltip();
                $('.remove_answer').unbind('click');
                $('.remove_answer').click(quitarRespuesta);
            });

            $('.remove_answer').click(quitarRespuesta);
        });
    </script>
@endsection