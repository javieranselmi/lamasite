@extends('layouts.main_layout')

@section('title', 'Etapa de Curso - ' . $course_stage->name)

@section('title_header', 'CURSOS')

@section('menu_background_image', asset('img/mis-cursos-top.png'))


@section('content')
    <!-- Introduccion -->
    <div class="jumbotron" style="background-color: #fff">
        <h1><a href="{{ route('courses') }}" style="color: rgb(77, 45, 121)">Cursos</a> / <a href="{{ route('course', $course_stage->course->id) }}" style="color: rgb(77, 45, 121)">{{ $course_stage->course->name }}</a> / {{ $course_stage->name }}</h1>
    </div>

    <!-- Lista de cursos y boton para ver mas cursos  -->
    <div class="container">
        <div class="row" style="margin-bottom: 10px;">
            <div class="row py-4 links-filtros">
                <div class="col-auto" onclick="window.location.href='{{ route('course', $course_stage->course->id) }}'" style="cursor: pointer;">
                    <img src="{{ asset('img/back-icon.png') }}" width="30">
                    <span class="px-2">VOLVER</span>
                </div>
            </div>
            <div class="col-12 text-center" id="titulo-cursos-disponibles">
                <h1>{{ $course_stage->name }}</h1>
            </div>
            @if($course_stage->type == 'html')
                <p>{{ $course_stage->html }}</p>
            @elseif($course_stage->type == 'ppt')
                <div class="col-12 text-center">
                    <iframe src="https://docs.google.com/viewer?url={{ $course_stage->ppt_url }}&embedded=true" style="width:680px; height:860px;" frameborder="0"></iframe>
                </div>
            @elseif($course_stage->type == 'vid_ppt')
                <div class="col-md-6">
                    @if(!is_null($course_stage->video_url))
                        <video id="course_stage_video" class="video-js" controls preload="auto" data-setup="{}" style="width: 565px; height: 435px;">
                            <source src="{{ $course_stage->video_url }}" type='video/mp4'>
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                    @endif
                </div>
                <div class="col-md-6" id="slides">
                    <?php
                        $slides = json_decode($course_stage->json_vid_ppt);
                    ?>
                    @foreach($slides as $slide)
                        <img src="{{ $slide->slide }}" id="slide_{{$slide->index}}" style="{{ $slide->index == 0 ? "" : "display: none;" }}"/>
                    @endforeach
                </div>
            @elseif($course_stage->type == 'questionnaire')
                @foreach($course_stage->questions as $question)
                    <div class="col-12 questionnaire">
                        <div class="alert alert-info">
                            <div class="form">
                                <label class="control-label" style="width: 570px;">{{ $question->title }}</label>
                                @foreach($question->answers as $index => $answer)
                                    <label class="radio" style="width: 570px;">
                                        <input value="" name="{{ $question->id }}[]" type="radio" {{ $index == 0 ? "checked" : "" }}>{{ $answer->content }}
                                        @if($answer->is_correct)
                                            <span class="question-answers badge badge-success" style="display:none;">Correcto</span>
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="check_questions">CORREGIR</button>
                    </div>
            @endif

        </div>
    </div>
@endsection

@section('custom_script')
    <script src="//vjs.zencdn.net/5.11/video.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('admin_assets/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxAmount = 1;
            var currentAmount = 0;

            window.setInterval(function(){
                var number = Math.floor(Math.random() * 100) + 1;
                console.log(number);
                if((number == 1 || number == 100) && currentAmount < maxAmount){
                    noty({
                        text: 'Queres ir a ver lo que tus colegas quisieron saber?',
                        buttons: [
                            {addClass: 'btn btn-primary', text: 'Si', onClick: function($noty) {
                                window.open('{{ route('course', $course_stage->course) }}#lo-que-tus-colegas', '_blank');
                                $noty.close();

                            }
                            },
                            {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
                                $noty.close();
                            }
                            }
                        ]
                    });
                    currentAmount++;
                }
            }, 2000);




            @if($course_stage->type == 'vid_ppt')
                var jsonVidPpt = JSON.parse('{!! $course_stage->json_vid_ppt !!}');
                var myPlayer = videojs('course_stage_video', {}, function onPlayerReady(){
                    this.on('timeupdate', function(time) {
                        //console.log('Current Time: ' + myPlayer.currentTime());
                        var currentSlide = jsonVidPpt.filter(function(slide){
                            return slide.video_position == Math.floor(myPlayer.currentTime());
                        });
                        if(currentSlide.length > 0){
                            $("#slides").children().each(function(slide){$($("#slides").children()[slide]).hide()});
                            $("#slide_"+currentSlide[0].index).show();
                        }
                    });
                });
            @elseif($course_stage->type == 'questionnaire')
                $("#check_questions").click(function(){
                    $("input[type=radio]").attr('disabled', true);
                    $(".question-answers").show();
                });
            @endif
        });
    </script>
@endsection