@extends('layouts.main_layout')

@section('title', 'Home')

@section('menu_background_image', asset('img/top-index.jpg'))

@section('menu_has_circle',true)

@section('outstanding_course')
    <div class="col-12 col-lg-6 pr-lg-0 mr-lg-0">
        <div id="circle">
            <div id='top-circle'>
                <a href="{{ !is_null($featured_course) ? route('course', $featured_course) : "#" }}">
                    <h1> {{ !is_null($featured_course) ? $featured_course->name : "No hay curso destacado" }} </h1>
                </a>
            </div>
            <div id='bottom-circle'>
                <div class="row no-gutters pt-1 mb-3 mb-md-0 mx-3">
                    <div class="col-12 col-lg-6 pl-lg-5 pr-lg-1" style="overflow: hidden; max-height: 200px;">
                        <p class="pt-2" style="text-align: justify;text-justify: inter-word;">
                            {{ !is_null($featured_course) ? str_limit($featured_course->description, $limit = 300, $end = '...') : "No hay curso destacado" }}
                        </p>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ !is_null($featured_course) ? route('course', $featured_course) : "#" }}">
                                    <img src="{{ !is_null($featured_course) ? Storage::url($featured_course->file->file_name) : "http://placehold.it/150x150" }}"
                                         width="125"/>
                                </a>
                            </div>
                        <!--<div class="col-12" style="padding-right: 2.2rem;">
                                <p>  !is_null($featured_course) ? $secondText : "No hay curso destacado" </p>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            @if (!is_null($featured_course))
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="py-2">
                            <a class="like_course p-1"
                               href="{{ route('like.store',['course_id' => $featured_course->id]) }}"
                               style="background-color: rgba(240, 240, 240, 0.7)">
                                <img class="pb-1 mr-2" width="20px" src="{{ asset('img/like-icon.png') }}">
                                <span style="color: rgb(77, 45, 121);">{{ $featured_course->likes->count() }}
                                    Me Gusta</span>
                            </a>
                        </p>
                    </div>
                </div>
        @endif
        <!--<div class="w-100 text-center py-2">
                <a href="#"><img src="{{ asset('img/like-icon.png') }}" width="15">
                    <span style="font-size: 1rem; color: rgba(94,29,116,0.9);" class="articulo-footer">500 Likes</span> </a>
            </div>-->
        </div>
    </div>
@endsection

@section('content')
    @if (!is_null($featured_product))
        @foreach($featured_product as $product)
            <div class="container pt-5" id="descripcion-producto">
                <div class="row align-items-center">
                    <div class="col-auto pr-2">
                        <img src="{{ Storage::url($product->photo->file_name) }}" style="width: 200px; height: auto;">
                    </div>
                    <div class="col pl-2">
                        <h1>INFORMACI&Oacute;N DE PRODUCTO</h1>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="col-12 mt-5">
                        <a href="{{ route('product_categories_detail', ['product_category_id' => $product->product_category->id, 'product_id' => $product->id]) }}"
                           class="nounderline">
                            <div id="saber-mas">
                                <p>Saber <br> m&aacute;s</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if (!is_null($news))


        <div class="container-fluid p-5" style="background: linear-gradient(90deg, rgba(190,178,207,1) 40%, white);">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-0" style="color: white;">NOVEDADES:</h2>
                </div>
                <div class="col-12" style="overflow: hidden;">
                    <div class="ticker">
                        <ul id="webTicker">
                            <li><p style="font-weight: 400; font-size: 24px;">{{ $news->text }}</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection

@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.like_course').click(function (e) {
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

        });
    </script>
@endsection