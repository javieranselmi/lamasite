@extends('layouts.main_layout')

@section('title', 'Categorias de Producto')

@section('title_header', 'PRODUCTOS')

@section('menu_background_image', asset('img/productos-top.png'))

@section('content')
    <!-- Introduccion -->
    <div class="jumbotron">
        <h1>INTRODUCCIÓN</h1>
        <p>{!! $texts->where('name', 'productos-introduccion')->first()->content !!}</p>
    </div>

    <div class="container-fluid my-5" id="categorias-productos">
        @foreach (array_chunk($product_categories, 2) as $productCategoryRow)
            <div class="row">
            @foreach($productCategoryRow as $product_category)
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-6 col pr-3 pl-0 align-self-center text-right">
                                <img class="img-fluid" src="{{ Storage::url($product_category->file->file_name) }}">
                            </div>
                            <div class="col-auto pl-3 my-3 text-center align-self-center">
                                <h1>{{ $product_category->name }}</h1>
                                <button type="button" onclick="window.location.href='{{ route('product_categories_detail', $product_category->id) }}'" class="btn btn-primary">Ver productos</button>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        @endforeach
    </div>
@endsection