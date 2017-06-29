@extends('layouts.main_layout')

@section('title', 'Curso - ' . $course->name)

@section('title_header', 'CURSOS')

@section('menu_background_image', asset('img/mis-cursos-top.png'))


@section('content')
    <!-- Introduccion -->
    <div class="jumbotron">
        <h1>{{ $course->name }}</h1>
        <p>{{ $course->description }}</p>
    </div>

    <!-- Lista de cursos y boton para ver mas cursos  -->
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" id="titulo-cursos-disponibles">
                <h1 class="py-3">ETAPAS DISPONIBLES</h1>
            </div>
            @foreach($course->course_stages as $course_stage)
                <div class="col-lg-6">
                    <div class="row curso">
                        <div class="col-5 nopadding ">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title text-white">{{ $course_stage->name }}</h4>
                                    <p class="card-text text-white" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $course_stage->description }} </p>
                                    <p class="card-text text-white">DURACION: <span class="badge align-text-top">{{ $course_stage->duration_in_minutes }} minutos</span> </p>
                                    <p class="card-text text-white">TIPO: <span class="badge badge-success align-text-top">
                                            @if($course_stage->type == 'html')
                                                HTML
                                            @elseif($course_stage->type == 'ppt')
                                                Presentaci&oacute;n
                                            @elseif($course_stage->type == 'vid_ppt')
                                                Video con Presentaci&oacute;n
                                            @elseif($course_stage->type == 'questionnaire')
                                                Multiple Choice
                                            @endif
                                        </span></p>
                                    <p class="card-text text-white">CURSADO: <span class="badge badge-{{ Auth::user()->didCompleteStage($course_stage->id) ? "success" : "danger" }} align-text-top">{{ Auth::user()->didCompleteStage($course_stage->id) ? "SI" : "NO" }}</span>
                                    </p>
                                    <p class="mb-0">
                                        <a href="#" data-target="#comments_courses" data-toggle="modal">
                                            <i class="fa fa-comments-o" aria-hidden="true" style="font-size: 26px;margin-right: 5px;color: #fff;"></i>
                                            <span style="font-size: 1rem; color: white;">
                                                 Lo que tus colegas quisieron saber
                                            </span>
                                        </a>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('course_stage', ['course_id' => $course->id, 'course_stage_id' => $course_stage->id]) }}" class="text-white nounderline">CURSAR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal" id="comments_courses" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1"><h1>Lo que tus colegas quisieron saber</h1></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div id="alert-share" class="alert alert-danger alert-dismissible" role="alert"
                                 style="display:none;">
                                <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <span id="alert-content"></span>
                            </div>
                            <div class="container" id="comment-section">
                                @include('components.comment', ['resource' => $course])
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function(){
           var openModal = (window.location.hash == '#lo-que-tus-colegas');
           if(openModal) {
               $('#comments_courses').modal('show');
           }
        });
    </script>
@endsection