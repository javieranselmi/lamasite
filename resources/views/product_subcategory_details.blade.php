@extends('layouts.main_layout')

@section('title', $product_subcategory->name)

@section('title_header', 'PRODUCTOS')

@section('menu_background_image', asset('img/productos-top.png'))

@section('content')
    <!-- Introduccion -->
    <div class="jumbotron" style="background-color: #fff;">
        <h1><a href="{{ route('product_categories') }}" style="color: rgb(77, 45, 121)">PRODUCTOS</a> / <a href="{{ route('product_categories_detail', $product_subcategory->product_category->id) }}" style="color: rgb(77, 45, 121)">{{ $product_subcategory->product_category->name }}</a> / {{ $product_subcategory->name }}</h1>
    </div>

    @include('components.product_category', ['category' => $product_subcategory->products])
@endsection