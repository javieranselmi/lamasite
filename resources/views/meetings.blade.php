@extends('layouts.main_layout')

@section('title', 'Reuniones de Ciclo')

@section('title_header', 'REUNIONES DE CICLO')

@section('menu_background_image', asset('img/ciclos-top.png'))


@section('content')
    <!-- Introduccion -->
    <div class="jumbotron">
        <h1>INTRODUCCI&Oacute;N</h1>
        <p>{!! $texts->where('name', 'ciclos-introduccion')->first()->content !!}</p>
    </div>
    <div class="container-fluid reuniones-ciclo my-3">
        @foreach($meetings->folders as $folder)
            <div class="row justify-content-center pb-5">
                <!-- Titulo de la agenda -->
                <div class="col-10 py-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-6">
                            <h2 class="float-left pb-0 mb-0">{{ $folder->name }}</h2>
                        </div>
                        <div class="col-12 col-sm-6 align-self-center text-right">
                            <a class="like_folder" href="{{ route('like.store',['folder_id' => $folder->id]) }}">
                                <img src="{{ asset('img/like-icon.png') }}">
                                <span class="mr-3 thin-font">{{ $folder->likes->count() }} Me Gusta</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Tabla con las fechas -->
                <div class="col-10">
                    <ul class="nav nav-tabs nav-fill flex-column flex-sm-row lista-reuniones" role="tablist">
                        @foreach($folder->folders as $index => $subcategory)
                            <li class="nav-item">
                                <a class="nav-link boton-lista {{ $index == 0 ? "active" : "" }}" data-toggle="tab"
                                   href="#tab{{$subcategory->id}}" role="tab">{{ $subcategory->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        @foreach($folder->folders as $index => $subcategory)
                            <div class="tab-pane fade show {{ $index == 0 ? "active" : "" }}"
                                 id="tab{{$subcategory->id}}" role="tabpanel">
                                <table class="table table-sm ">
                                    <tbody>
                                    @foreach($subcategory->folders as $subcategoryFolder)
                                        <tr>
                                            <td><img src="{{ asset('img/folder-icon.png') }}"/></td>
                                            <td class="regular-font"><a href="#" class="folder"
                                                                        data-folder_id="{{ $subcategoryFolder->id }}">{{ $subcategoryFolder->name }}</a>
                                            </td>
                                            <td class="thin-font">{{ $subcategoryFolder->created_at }}</td>
                                            <td></td>
                                            <!--<td class="thin-font">por FOUR GLOBAL</td>-->
                                        </tr>
                                    @endforeach

                                    @foreach($subcategory->files as $subcategoryFile)
                                        <tr>
                                            <td>
                                                <i style="font-size: 1.4rem;" class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                            </td>
                                            <td class="regular-font"><a href="{{ $subcategoryFile->url }}"
                                                                        target="_blank">{{ $subcategoryFile->file_name_original }}</a>
                                            </td>
                                            <td class="thin-font">{{ $subcategoryFile->created_at }}</td>
                                            <!--<td class="thin-font">por FOUR GLOBAL</td>-->
                                            <td>
                                                {{--<a href="{{ $subcategoryFile->url }}" target="_blank"> <img--}}
                                                            {{--src="{{ asset('img/nueva-ventana-icon.png') }}"> </a>--}}
                                                <a href="{{ route('meetings_download_file', $subcategoryFile) }}" download="{{ $subcategoryFile->file_name_original }}">
                                                    <i style="font-size: 1.4rem; color: #ab9ac0;" class="px-2 fa fa-download" aria-hidden="true"></i>
                                                </a>


                                                <a href="#" class="share-link" data-file_id="{{ $subcategoryFile->id }}">
                                                    <i style="font-size: 1.4rem; color: #ab9ac0;" class="px-2 fa fa-share-square-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Menu inferior -->
                <div class="col-10 mb-3">
                    <div class="row justify-content-end pr-3">
                        <span class="mx-2 thin-font" style="font-size: 1rem;">
                                Compartir
                                <i class="fa fa-share-square-o" aria-hidden="true"></i>
                        </span>
                        <span class="mx-2 thin-font" style="font-size: 1rem;">
                                Descargar
                                <i class="fa fa-download" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal" id="share-file" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Compartir archivo</h4>
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
                        <p> Comparte este archivo </p>
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
                                      placeholder="Ingrese un comentario acerca del archivo">Te comparto este archivo de interés:…</textarea>
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

            $('.like_folder').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
                var tag = $(this);

                if ($(this).data('requestRunning')) {
                    return;
                }

                $(this).parent().append('<img class="img-fluid" style="width: 20px;" id="loading" src={{ asset('img/loading-icon.svg') }} />')
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

            var shareClickFunction = function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();

                $('#share-file').find('#form_comentario').val('Te comparto este archivo de interés:…');

                $('#share-file')
                    .modal('show')
                    .data('file_id', $(this).data('file_id'));
            };

            $('.share-link').click(shareClickFunction);

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
                    url: '{{ route('share_file') }}',
                    type: 'POST',
                    data: {
                        'file_id': $('#share-file').data('file_id'),
                        'email': $('#form_email').val(),
                        'comentario': $('#form_comentario').val()
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.status);
                        console.log(result.file_id);

                        $('#share-file').modal('hide');
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

            var categoriesServed = {{ $meetings->folders->pluck('id') }};

            var folderClick = function (e) {
                e.preventDefault();
                var folder_id = $(this).data('folder_id');
                var esto = this;

                $.get(laroute.route('meetings_list_folder', {folder_id: folder_id}), {}, function (data) {
                    console.log(data);
                    var tbody = $(esto).parentsUntil('tbody').parent().first();
                    tbody.html('');

                    if (categoriesServed.indexOf(data.parent_id) === -1) {
                        var append = '<tr> \
                                      <td><img src="{{ asset('img/folder-icon.png') }}" /></td> \
                                       <td class="regular-font"> <a href="#" class="folder" data-folder_id="' + data.parent_id + '">..</a></td> \
                                       <!--<td class="thin-font">por FOUR GLOBAL</td>--> \
                                       <td></td>\
                                       <td></td>\
                                   </tr>';
                        tbody.append(append);
                    }


                    data.folders.forEach(function (folder) {
                        var append = '<tr> \
                                      <td><img src="{{ asset('img/folder-icon.png') }}" /></td> \
                                       <td class="regular-font"> <a href="#" class="folder" data-folder_id="' + folder.id + '">' + folder.name + '</a></td> \
                                       <td class="thin-font">' + folder.created_at + '</td> \
                                       <!--<td class="thin-font">por FOUR GLOBAL</td>--> \
                                       <td></td>\
                                   </tr>';
                        tbody.append(append);
                    });

                    $(".folder").unbind('click');
                    $(".folder").click(folderClick);

                    data.files.forEach(function (file) {
                        var append = '<tr> \
                                        <td><img src="{{ asset('img/pdf-icon.png') }}" /></td> \
                                        <td class="regular-font"> <a href="' + file.url + '" target="_blank">' + file.file_name_original + '</a></td> \
                                        <td class="thin-font">' + file.created_at + '</td> \
                                        <!--<td class="thin-font">por FOUR GLOBAL</td>--> \
                                        <td> \
                                            <a href="' + laroute.route("meetings_download_file", {file_id: file.id}) + '" download="' + file.file_name_original + '"> <i style="font-size: 1.4rem; color: #ab9ac0;" class="px-2 fa fa-download" aria-hidden="true"></i> </a>\
                                            <a href="#" class="share-link" data-file_id="'+file.id+'"> <i style="font-size: 1.4rem; color: #ab9ac0;" class="px-2 fa fa-share-square-o" aria-hidden="true"></i> </a> \
                                             \
                                        </td> \
                                    </tr>';
                        tbody.append(append);
                        $('.share-link').unbind("click");
                        $('.share-link').click(shareClickFunction);
                    });

                });
            };

            $(".folder").click(folderClick);
        });
    </script>
@endsection