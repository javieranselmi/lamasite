@extends('layouts.main_layout')

@section('title', 'Biblioteca - ' . $post->title)

@section('title_header', 'BIBLIOTECA')

@section('menu_background_image', asset('img/biblioteca-top.png'))

@section('content')
    <!-- Introduccion -->
    <div class="jumbotron">
        <h1>INTRODUCCI&Oacute;N</h1>
        <p>{!! $texts->where('name', 'biblioteca-multimedia-introduccion')->first()->content !!}</p>
    </div>

    <div class="container-fluid px-md-5 px-3 pb-4" id="articulos">
        <div class="row py-4 links-filtros">
            <div class="col-auto">
                <a href="{{ route('library') }}">
                    <img src="{{ asset('img/back-icon.png') }}" width="30">
                    <span class="px-2">VOLVER</span>
                </a>
            </div>
        </div>

        <div class="row py-3 articulo">
            <div class="col-12 col-sm-2 pl-0 pr-3 text-right img-articulo">
                <div class="row justify-content-end">
                    <div class="col-12">
                        <img class="img-fluid" src="{{ Storage::url($post->file->file_name) }}"
                             alt="Generic placeholder image">
                    </div>
                    <div class="col-sm-auto col-12">
                        <a class="like_post" href="{{ route('like.store',['post_id' => $post->id]) }}"><img
                                    src="{{ asset('img/like-icon.png') }}" width="15">
                            <span class="mr-1 articulo-footer">{{ $post->likes->count() }} Me Gusta</span> </a>
                    </div>
                    <div class="col-sm-auto col-12">
                        <a id="share-link" href="#" data-toggle="modal" data-target="#share_post" data-content="{{ $post->id }}"><img src="{{ asset('img/share-icon.png') }}" width="15">
                            <span id="share_count"  class="articulo-footer">{{ $post->share_count }}
                                Compartir</span> </a>
                    </div>
                </div>
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
                            {{ $post->content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="comment-section">
            @include('components.comment', ['resource' => $post])
        </div>
    </div>

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
    <script type="text/javascript">
        $(document).ready(function () {

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
        });
    </script>
@endsection