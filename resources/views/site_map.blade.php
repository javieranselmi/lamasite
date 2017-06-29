@extends('layouts.main_layout')

@section('title', 'Mapa de Sitio')

@section('title_header', 'MAPA DE SITIO')

@section('menu_background_image', asset('img/productos-top.png'))

@section('content')



    <div class="container-fluid my-5">
        <ul>
            <li>
                <a href="{{ route('product_categories') }}">Categorias de Producto</a>
                <ul>
                    @foreach($product_categories as $product_category)
                        <li>
                            <a href="{{ route('product_categories_detail', $product_category) }}">{{ $product_category->name }}</a>
                            @if($product_category->products->count() > 0)
                                <ul>
                                    @foreach($product_category->products as $product)
                                        <li>
                                            <a href="{{ route('product_categories_detail', ['product_category_id' => $product->product_category->id, 'product_id' => $product->id]) }}">{{ $product->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                     @endforeach
                </ul>
            </li>

            <li>
                <a href="{{ route('courses') }}">Cursos</a>
                <ul>
                    @foreach($courses as $course)
                        <li>
                            <a href="{{ route('course', $course) }}">{{ $course->name }}</a>
                            @if($course->course_stages->count() > 0)
                                <ul>
                                    @foreach($course->course_stages as $course_stage)
                                        <li>
                                            <a href="{{ route('course_stage', ['course_id' => $course, 'course_stage_id' => $course_stage]) }}">{{ $course_stage->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>

            <li>
                <a href="{{ route('library') }}">Biblioteca</a>
                <ul>
                    @foreach($posts as $post)
                        <li>
                            <a href="{{ route('library_post', $post) }}">{{ $post->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
@endsection