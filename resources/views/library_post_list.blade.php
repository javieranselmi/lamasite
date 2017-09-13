@extends('layouts.main_layout')

@section('title', 'Biblioteca')

@section('title_header', 'BIBLIOTECA')

@section('menu_background_image', asset('img/biblioteca-top.png'))

@section('content')
    <!-- Introduccion -->
    <div class="jumbotron">
        <h1>INTRODUCCI&Oacute;N</h1>
        <p>{!! $texts->where('name', 'biblioteca-multimedia-introduccion')->first()->content !!}</p>
    </div>

    <div class="container-fluid px-md-5 px-3 pb-4" id="articulos">
        <div class="row p-5 text-center justify-content-center links-filtros">
            <div class="col-auto py-3">
                <span class="px-2">FILTRAR: </span>
            </div>
            <div class="col-auto py-3">
                <a class="mx-3 my-3 link-filtro active" id="todos" href="#">TODOS</a>
            </div>
            <div class="col-auto py-3">
                <a class="mx-3 my-3 link-filtro" id="populares" href="#">POPULARES</a>
            </div>
            <div class="col-auto py-3">
                <a class="mx-3 my-3 link-filtro" id="recientes" href="#">RECIENTES</a>
            </div>
        </div>
        <div id="articulos-holder">
            @foreach($posts as $index => $post)
                <div class="row py-3 articulo" id="{{ $post->id }}" data-index="{{ $index }}" data-visits="{{ $post->visits }}" data-timestamp="{{ $post->created_at->timestamp }}" style="{{ $index > 5 ? "display:none" : "" }}">
                    <div class="col-12 col-sm-2 px-3 text-right img-articulo">
                        <img class="img-fluid" src="{{ Storage::url($post->file->file_name) }}"
                             alt="Generic placeholder image">
                    </div>
                    <div class="col pl-2 cuerpo-articulo">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mt-0">{{ $post->title }}</h5>
                            </div>
                            <div class="col-12 py-3">
                                <div class="row">
                                    <div class="col-sm-auto col-12 articulo-header">
                                        <a href="#"> <img src="{{ asset('img/user-icon.png') }}">
                                            <span class="ml-2 mr-4 ">{{ $post->user->name }}</span> </a>
                                    </div>
                                    <div class="col-sm-auto col-12 articulo-header">
                                        <img src="{{ asset('img/date-icon.png') }}">
                                        <span class="ml-2 mr-4 ">{{ $post->created_at->format('d-m-Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="mt-2 text-muted">
                                    {{ $post->description }}
                                </p>
                            </div>
                            <div class="col-sm-auto col-12">
                                <a class="like_post" href="{{ route('like.store',['post_id' => $post->id]) }}"><img
                                            src="{{ asset('img/like-icon.png') }}">
                                    <span class="mr-1 articulo-footer">{{ $post->likes->count() }} Me Gusta</span> </a>
                            </div>
                            <div class="col-sm-auto col-12">
                                <a id="share-link" href="#" data-toggle="modal" data-target="#share_post" data-content="{{ $post->id }}">
                                    <i style="font-size: 1.4rem;color: #a962a0;position: absolute;top: 3px;" class="px-2 fa fa-share-square-o" aria-hidden="true"></i>
                                    <span id="share_count" class="mr-3 articulo-footer" style="margin-left: 35px;">{{ $post->share_count }} Compartir</span> </a>
                            </div>
                            <!--<div class="col-sm-auto col-12">
                                <img src="{{ asset('img/comment-icon.png') }}">
                                <span class="mr-3 articulo-footer">{{ $post->comments->count() }} comentarios</span>
                            </div>-->
                            <div class="col-sm col-12">
                                <button onclick="window.location.href='{{ route('library_post', $post->id) }}'"
                                        class="btn btn-primary float-right mr-2" style="cursor: pointer;">
                                    Leer m&aacute;s
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($posts->count() > 6)
        <div class="col-12 mt-5">
            <a href="#" class="nounderline underline">
                <div id="mas-cursos">
                    <p>M&aacute;s &aacute;rticulos</p>
                </div>
            </a>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal" id="share_post" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Compartir &aacute;rticulo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="alert-share" class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
                            <button type="button" class="close" onclick="$('#alert-share').hide();" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span id="alert-content"></span>
                        </div>
                        <p> Comparte este &aacute;rticulo </p>
                        <div class="form-group">
                            <label for="form_email">Email *</label>
                            <input id="form_email" type="email" name="email" class="form-control"
                                   placeholder="Ingrese el email de destino" required="required"
                                   data-error="Se requiere un email valido.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="send_share" type="button" class="btn btn-primary" >Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('custom_script')
    <script type="text/javascript"
            src="{{ asset('admin_assets/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    <script type="text/javascript">



        $(document).ready(function () {

            $('#mas-cursos').parent().click(function(e){
                e.preventDefault();
                $('.articulo:hidden').show();
                $(this).parent().hide();
            });

            $('#share-link').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
                $('#share_post').modal();
                $('#share_post').data('content',$(this).data('content'));
            });

            $('#send_share').click(function (e) {
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
                    url: '/biblioteca/articulo/share',
                    type: 'POST',
                    data: {
                        'post_id' : $('#share_post').data('content'),
                        'email' : $('#form_email').val(),
                        'message' : $('#form_message').val()
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.status);
                        $('#share_count').text(result.share_count + ' Compartir');
                        $('#share_post').modal('hide');
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.like_post').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
                var tag = $(this);

                if ($(this).data('requestRunning')) {
                    return;
                }

                $(this).parent().append('<img style="width: 28px;" id="loading" src={{ asset('img/loading-icon.svg') }} />')
                $(this).data('requestRunning', true);

                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.status);
                        console.log(result.count);
                        tag.parent().find('span').text(result.count + ' Me Gusta');
                        tag.data('requestRunning', false);
                        tag.parent().find('#loading').remove();
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                    }
                })
            });

            var orderBy = function(key, order){
                $('#articulos-holder').html($('.articulo').sort(function (a, b) {
                    var contentA = parseInt( $(a).attr('data-' + key));
                    var contentB  =parseInt( $(b).attr('data-' + key));
                    if(order == 'desc')
                        return (contentB < contentA) ? -1 : (contentB > contentA) ? 1 : 0;
                    else
                        return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;

                }));
            };

            $("#todos").click(function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                orderBy('index');
                $("#populares").removeClass('active');
                $("#recientes").removeClass('active');
                $(this).addClass('active');
            });

            $("#populares").click(function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                orderBy('visits', 'desc');

                $("#todos").removeClass('active');
                $("#recientes").removeClass('active');
                $(this).addClass('active');
            });

            $("#recientes").click(function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                orderBy('timestamp', 'desc');

                $("#populares").removeClass('active');
                $("#todos").removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endsection