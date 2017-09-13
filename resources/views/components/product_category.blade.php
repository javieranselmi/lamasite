<div class="container-fluid my-5" id="listado-productos">
    @if(count($category) > 0)
        <div class="col-12 text-center" id="titulo-cursos-disponibles">
            <h1 class="py-3">PRODUCTOS</h1>
        </div>
        @foreach(array_chunk($category->all(), 2) as $productRow)
            <div class="row">
                @foreach($productRow as $product)
                    <div class="col-md-6" id="product-{{ $product->id }}">
                        <div class="row my-3" style="max-height:300px;">
                            <div class="col-sm-4 col pr-3 pl-0 align-self-center text-right">
                                <img class="img-fluid" src="{{ Storage::url($product->thumb->file_name) }}">
                            </div>
                            <div class="col-md-6 col pl-3 align-self-center">
                                <h1>{{ $product->name }}</h1>
                                <div class="my-2"
                                     style="background-color: rgb(94,29,116); height: 5px; width: 80px;"></div>
                                <p class="my-1">{{ $product->subtitle }}</p>

                                <p class="my-1">
                                    <a href="{{ route('like.store') }}" class="like-product"
                                       data-product_id="{{ $product->id }}">
                                        <img src="{{ asset('img/like-icon.png') }}" width="15">
                                        <span style="font-size: 0.8rem;" class="product_likes_count">{{ $product->likes->count() }}
                                            Me Gusta</span>
                                    </a>
                                    <br/>
                                    <a href="#" class="share-link" data-product_id="{{ $product->id }}">
                                        <!--<img src="{{ asset('img/share-icon.png') }}" width="15">-->
                                            <i style="font-size: 1.1rem;color: #a962a0;margin-left: -7px;" class="px-2 fa fa-share-square-o" aria-hidden="true"></i>
                                        <span style="font-size: 0.8rem; margin-left: -10px;" class="product_shares_count">{{ $product->share_count }}
                                            Compartir</span>
                                    </a>
                                </p>

                                <button type="button" id="{{ $product->id }}" data-product_id="{{ $product->id }}"
                                        data-target="#product_detail_modal" data-toggle="modal"
                                        data-product_name="{{ $product->name }}"
                                        data-product_components='{!! $product->components !!}'
                                        data-product_image_url="{{ Storage::url($product->photo->file_name) }}"
                                        data-product_share_count="{{ $product->share_count }}"
                                        data-product_likes_count="{{ $product->likes->count() }}"
                                        data-product_related_courses='{!! json_encode($product->courses, JSON_HEX_APOS) !!}'
                                        data-product_related_files='{!! json_encode($product->files, JSON_HEX_APOS) !!}'
                                        class="btn btn-primary">Conocer m&aacute;s
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>

<div class="modal mt-5" id="product_detail_modal" tabindex="-1" role="dialog" aria-labelledby="product_detail_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content container producto-popup" style="background: transparent; border: none;">


            <div class="row">
                <div class="col offset-lg-4">
                    <h1 class="mt-0" id="product_name">Un nombre de producto relativamente mas largo 12:1</h1>
                </div>
            </div>
            <div class="row" style="background: white; padding: 10px">
                <div class="col-12 col-sm-4 px-0 px-sm-3 text-right img-articulo">
                    <div class="row">
                        <div class="col-12">
                            <img class="img-fluid" id="product_image" src="" alt="Generic placeholder image">
                            <!--style="margin-top: -30px"-->
                        </div>
                        <div class="col-sm-auto col-12">
                            <a href="{{ route('like.store') }}" class="like-product"><img
                                        src="{{ asset('img/like-icon.png') }}" width="15">
                                <span style="font-size: 0.8rem;" class="product_likes_count">500 Me Gusta</span> </a>
                        </div>
                        <div class="col-sm-auto col-12">
                            <a href="#" class="share-link"><i style="font-size: 1.1rem;color: #a962a0;margin-left: -7px;position: absolute;top: 7px;" class="px-2 fa fa-share-square-o" aria-hidden="true"></i>
                                <span style="font-size: 0.8rem;margin-left: 20px;" class="product_shares_count">12.8 Compartir</span> </a>
                        </div>
                    </div>
                </div>
                <div class="col pl-2">
                    <div class="row">
                        <div class="col-11 pt-4">
                            <h3 id="product_title">Componentes</h3>
                            <p class="text-muted" id="product_components">

                            </p>

                            <h3 id="product_title">Cursos</h3>
                            <ul id="product_courses">

                            </ul>
                            <p class="text-muted" id="product_no_courses" style="display: none;">
                                No hay cursos relacionados con este producto.
                            </p>

                            <h3 id="product_title">Archivos</h3>
                            <ul id="product_files" style="list-style: none;">

                            </ul>
                            <p class="text-muted" id="product_no_files" style="display: none;">
                                No hay archivos relacionados con este producto.
                            </p>
                        </div>

                        <div class="col-1 px-0 text-right">
                            <a data-dismiss="modal">
                                <img class="img-fluid" src="{{ asset('img/close-icon.png') }}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="share-product" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Compartir producto</h4>
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
                    <p> Comparte este producto </p>
                    <div class="form-group">
                        <label for="form_email">Email *</label>
                        <input id="form_email" type="email" name="email" class="form-control"
                               placeholder="Ingrese el email de destino" required="required"
                               data-error="Se requiere un email valido.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="send-share" type="button" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('custom_script')
    <script src="{{ asset('js/purl.js') }}"></script>
    <script src="{{ asset('admin_assets/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#product_detail_modal').on('show.bs.modal', function (e) {
                //get data-id attribute of the clicked element

                var relatedTarget = $(e.relatedTarget);
                var productPhoto = relatedTarget.data('product_image_url');
                var productComponents = relatedTarget.data('product_components');
                var productName = relatedTarget.data('product_name');
                var productShareCount = relatedTarget.data('product_share_count');
                var productLikeCount = relatedTarget.data('product_likes_count');
                var productRelatedCourses = relatedTarget.data('product_related_courses');
                var productRelatedFiles = relatedTarget.data('product_related_files');


                new Metrics().publishProductVisit(relatedTarget.data('product_id'));

                var modal = $('#product_detail_modal');

                $('#product_name').html(productName);
                $("#product_image").attr('src', productPhoto);
                modal.find(".product_shares_count").html(productShareCount + " Compartir");
                modal.find(".product_likes_count").html(productLikeCount + " Me Gusta");
                $("#product_components").html(productComponents);



                modal.find('.share-link').data('product_id', relatedTarget.data('product_id'));
                modal.find('.like-product').data('product_id', relatedTarget.data('product_id'));

                if (productRelatedCourses.length > 0) {
                    $('#product_no_courses').hide();
                    $('#product_courses').show();

                    productRelatedCourses.forEach(function (course) {
                        $("#product_courses").append("<li><a href='{{ route('course', null) }}/" + course.id + "'>" + course.name + "</a></li>");
                    });
                } else {
                    $('#product_no_courses').show();
                    $('#product_courses').hide();
                }

                if (productRelatedFiles.length > 0) {
                    $('#product_no_files').hide();
                    $('#product_files').show();

                    productRelatedFiles.forEach(function (file) {
                        $("#product_files").append("<li><i class='fa fa-paperclip' aria-hidden='true'></i> <a href='" + file.url + "' target='_blank'>" + file.file_name_original + "</a></li>");
                    });
                } else {
                    $('#product_no_files').show();
                    $('#product_files').hide();
                }

            });

            if ($.url().param('product_id') != "") {
                var button = $('button[data-product_id=' + $.url().param('product_id') + ']');
                if (button.length > 0) {
                    $('button[data-product_id=' + $.url().param('product_id') + ']').trigger('click');
                }
            }

            $('.share-link').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();

                $('#product_detail_modal').modal('hide');

                $('#share-product')
                    .modal('show')
                    .data('product_id', $(this).data('product_id'));
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
                    url: '{{ route('share_product') }}',
                    type: 'POST',
                    data: {
                        'product_id': $('#share-product').data('product_id'),
                        'email': $('#form_email').val()
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.status);
                        console.log(result.share_count);
                        console.log(result.product_id);
                        $('#' + result.product_id).data('product_share_count', result.share_count);
                        $('#product-' + result.product_id).find('.product_shares_count').html(result.share_count + " Compartir");

                        $('#share-product').modal('hide');
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


            $('.like-product').click(function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();

                if ($(this).data('requestRunning')) {
                    return;
                }

                $(this).parent().append('<img style="width: 28px;" id="loading" src={{ asset('img/loading-icon.svg') }} />')
                $(this).data('requestRunning', true);

                var url = $(this).attr('href');
                var tag = $(this);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'product_id': tag.data('product_id')
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log(result.status);
                        console.log(result.count);
                        $('#' + result.product_id).data('product_likes_count', result.count);
                        $('#product_detail_modal').find('.product_likes_count').html(result.count + " Me Gusta");
                        $('#product-' + result.product_id).find('.product_likes_count').html(result.count + " Me Gusta");
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