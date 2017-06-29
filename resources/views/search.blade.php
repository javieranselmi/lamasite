@extends('layouts.main_layout')

@section('title', 'Busqueda')

@section('menu_background_image', asset('img/top-index.jpg'))

@section('content')
    <div class="container-fluid pb-4" style="background: linear-gradient(180deg, rgba(141, 10, 119, 0.2), white 75%);">
        <div class="row">
            <div class="col-12 text-center py-4">
                <h1>RESULTADOS</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9 col" style="">
                <div class="list-group">
                    @foreach($product_results as $product)
                        <a href="{{ route('product_categories_detail', ['product_category_id' => $product->product_category->id, 'product_id' => $product->id]) }}"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="mb-1">{{ $product->name }}</h5>
                                            <p class="mb-1">Producto</p>
                                            {{--<small>{{ $product->created_at }}</small>--}}
                                        </div>
                                        <div class="col-12 col-sm-auto">
                                            <img class="img-fluid" src="{{ Storage::url($product->thumb->file_name) }}" style="max-width: 150px;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @foreach($course_results as $course)
                        <a href="{{ route('course', ['course_id' => $course->id]) }}"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="mb-1">{{ $course->name }}</h5>
                                            <p class="mb-1">Curso</p>
                                            {{--<small class="text-muted">{{ $course->created_at }}.</small>--}}
                                        </div>
                                        <div class="col-12 col-sm-auto">
                                            <img class="img-fluid" src="{{ Storage::url($course->file->file_name) }}" style="max-width: 150px;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @foreach($post_results as $post)
                        <a href="{{ route('library_post', ['post_id' => $post->id]) }}"
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="mb-1">{{ $post->title }}</h5>
                                            <p class="mb-1">Articulo</p>
                                            {{--<p class="mb-1">{{ $post->description }}</p>--}}
                                            {{--<small class="text-muted">{{ $post->created_at }}</small>--}}
                                        </div>
                                        <div class="col-12 col-sm-auto">
                                            <img class="img-fluid" src="{{ Storage::url($post->file->file_name) }}" style="max-width: 150px;"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection