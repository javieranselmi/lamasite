@extends('layouts.main_layout')

@section('title', 'Mis Cursos')

@section('title_header', 'MIS CURSOS')

@section('menu_background_image', asset('img/mis-cursos-top.png'))


@section('content')
    <!-- Introduccion -->
    <div class="jumbotron">
        <h1>INTRODUCCIÓN</h1>
        <p>{!! $texts->where('name', 'cursos-introduccion')->first()->content !!}</p>
    </div>

    <!-- Rendimiento del curso  -->
    <div class="jumbotron px-0 py-0" id="jumbo-rendimiento">
    <!--<div class="row mr-0 mb-5">
            <div class="offset-md-1 col-md-5">
                <h1>MI RENDIMIENTO</h1>
                <p>{!! $texts->where('name', 'cursos-mi-rendimiento')->first()->content !!}</p>
            </div>
            <div class="col-md-5 text-center" id="cursos-realizados">
                <h1>{{ Auth::user()->getFinishedCourses()->count() }}/{{ $courses->count() }}</h1>
                <h2>CURSOS REALIZADOS</h2>
            </div>
            <div class="col-md-1">
                <a href="#">
                    <div id="mas-info">
                        <p>Mas info</p>
                    </div>
                </a>
            </div>
        </div>-->
        <div class="row no-gutters mx-0 px-0" id="ver-cursos">
            <div class="offset-md-1 col-md-5 text-center pb-2 pb-md-0">
                <a href="#" class="btn-link nounderline" data-toggle="modal" data-target="#cursosRealizados">VER CURSOS
                    REALIZADOS</a>
            </div>
            <div class="col-md-5 text-center pt-2 pt-md-0">
                <a href="#" class="btn-link nounderline" data-toggle="modal" data-target="#cursosPendientes">VER CURSOS
                    PENDIENTES</a>
            </div>
        </div>
    </div>

    <!-- Lista de cursos y boton para ver mas cursos  -->
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" id="titulo-cursos-disponibles">
                <h1 class="py-3">CURSOS DISPONIBLES</h1>
            </div>
            @foreach($courses as $index => $course)
                <div class="col-lg-6 course py-2" id="course-{{ $course->id }}" style="{{ $index > 5 ? "display:none" : "" }}">
                    <div class="row curso">
                        <div class="col-5 p-0">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title text-white">{{ $course->name }}</h4>
                                    <p class="card-text text-white"
                                       style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $course->description }} </p>
                                    <p class="card-text text-white">ESTADO: <span
                                                class="badge badge-success align-text-top">DISPONIBLE</span>
                                    <p class="mb-0">
                                        <a class="like_course" href="{{ route('like.store',['course_id' => $course->id]) }}">
                                            <img class="pb-1 mr-2" width="15px" src="{{ asset('img/like-icon.png') }}">
                                            <span style="font-size: 1rem; color: white;" class="course_likes_count">
                                                {{ $course->likes->count() }} Me Gusta
                                            </span>
                                        </a>
<br>
                                        <a href="#" class="share-link" data-course_id="{{ $course->id }}">
                                            <i style="font-size: 1.1rem;color: #8c3e8a;margin-left: -7px;" class="px-2 fa fa-share-square-o" aria-hidden="true"></i>
                                            <span style="font-size: 1rem;color: white;margin-left: -3px;" class="course_share_count">
                                                {{ $course->share_count }} Compartir
                                            </span>
                                        </a>
                                    </p>

                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route("course", $course->id) }}" class="text-white nounderline">CURSAR
                                        ON-LINE</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7"
                             style="background: url('{{ Storage::url($course->file->file_name) }}') center no-repeat; background-size: cover;">
                            <a href="{{ route("course", $course->id) }}"><img class="img-fluid" id="img-curso"
                                                                              src="{{ asset('img/playbutton.png') }}"
                                                                              height="60" width="60"></a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($courses->count() > 6)
                <div class="col-12 mt-5">
                    <a href="#" class="nounderline underline">
                        <div id="mas-cursos">
                            <p>M&aacute; cursos</p>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="modal" id="cursosRealizados" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="eventsOfDay">Cursos Realizados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="eventList">
                        @if(Auth::user()->getFinishedCourses()->count() > 0)
                            @foreach(Auth::user()->getFinishedCourses() as $finishedCourse)
                                <li>
                                    <a href="{{ route("course", $finishedCourse->id) }}">{{ $finishedCourse->name }}</a>
                                </li>
                            @endforeach
                        @else
                            No haz finalizado ningun curso aun.
                        @endif

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="cursosPendientes" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="eventsOfDay">Cursos Pendientes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="eventList">
                        @if(Auth::user()->getPendingCourses()->count() > 0)
                            @foreach(Auth::user()->getPendingCourses() as $pendingCourse)
                                <li>
                                    <a href="{{ route("course", $pendingCourse->id) }}">{{ $pendingCourse->name }}</a>
                                </li>
                            @endforeach
                        @else
                            Haz finalizado todos los cursos!
                        @endif

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="share-course" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Compartir curso</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="alert-share" class="alert alert-danger alert-dismissible" role="alert"
                             style="display:none;">
                            <button type="button" class="close" onclick="$('#alert-share').hide();" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span id="alert-content"></span>
                        </div>
                        <p> Comparte este curso </p>
                        <div class="form-group">
                            <fieldset disabled>
                                <label for="form-from">Remitente</label>
                                <input type="text" id="form-from" class="form-control" placeholder="Disabled input" value="{{ Auth::user()->email }}">
                            </fieldset>

                            <label for="form_email">Email *</label>
                            <input id="form_email" type="email" name="email" class="form-control"
                                   placeholder="Ingrese el email de destino" required="required"
                                   data-error="Se requiere un email valido.">
                            <div class="help-block with-errors"></div>

                            <label for="form_comentario">Comentario</label>
                            <textarea id="form_comentario"
                                    name="comentario"
                                    class="form-control"
                                    placeholder="Ingrese un comentario acerca del curso">Te comparto este link de interés:…</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="send-share" type="button" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#mas-cursos').parent().click(function (e) {
                e.preventDefault();
                $('.course:hidden').show();
                $(this).parent().hide();
            });

            $('.like_course').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
                var tag = $(this);

                if ($(this).data('requestRunning')) {
                    return;
                }

                $(this).parent().find('.course_likes_count').append('<img style="width: 28px;" id="loading" src={{ asset('img/loading-icon.svg') }} />')
                $(this).data('requestRunning', true);

                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.status);
                        console.log(result.count);
                        tag.parent().find('.course_likes_count').text(result.count + ' Me Gusta');
                        tag.data('requestRunning', false);
                        tag.parent().find('#loading').remove();
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                    }
                })
            });

            $('.share-link').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();

                $('#share-course').find('#form_comentario').val('Te comparto este link de interés:…');

                $('#share-course')
                    .modal('show')
                    .data('course_id', $(this).data('course_id'));
            });

            $('#send-share').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
                var tag = $(this);

                if ($(this).data('requestRunning')) {
                    return;
                }

                $(this).parent().append('<img style="width: 28px;" id="loading" src={{ asset('img/loading-icon.svg') }} />')
                $(this).data('requestRunning', true);

                $.ajax({
                    url: '{{ route('share_course') }}',
                    type: 'POST',
                    data: {
                        'course_id': $('#share-course').data('course_id'),
                        'email': $('#form_email').val(),
                        'comentario': $('#form_comentario').val()
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.status);
                        console.log(result.share_count);
                        console.log(result.course_id);
                        $('#course-' + result.course_id).find('.course_share_count').html(result.share_count + " Compartir");

                        $('#share-course').modal('hide');
                        noty({
                            text: 'Mail enviado correctamente!',
                            type: 'success',
                            theme: 'metroui',
                            layout: 'topRight',
                            timeout: 4000,
                            progressBar: true,
                            closeWith: ['click'],
                            animation: {
                                open: 'animated fadeInDown',
                                close: 'animated fadeOutUp'
                            }
                        });
                        tag.data('requestRunning', false);
                        tag.parent().find('#loading').remove();
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        $('#alert-share').show();
                        $('#alert-content').text('El email es invalido, intenta nuevamente');
                        tag.data('requestRunning', false);
                        tag.parent().find('#loading').remove();
                    }
                })
            });

        });
    </script>
@endsection