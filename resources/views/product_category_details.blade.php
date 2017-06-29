@extends('layouts.main_layout')

@section('title', $product_category->name)

@section('title_header', 'PRODUCTOS')

@section('menu_background_image', asset('img/productos-top.png'))

@section('content')
    <!-- Introduccion -->
    <div class="jumbotron" style="background-color: #fff;">
        <h1><a href="{{ route('product_categories') }}" style="color: rgb(77, 45, 121)">PRODUCTOS</a> / {{ $product_category->name }}</h1>
    </div>

    <div class="container-fluid my-5" id="listado-productos">
        @if(count($product_category->product_subcategories) > 0)
            <div class="col-12 text-center" id="titulo-cursos-disponibles">
                <h1 class="py-3">SUBCATEGORIAS</h1>
            </div>
            @foreach(array_chunk($product_category->product_subcategories->all(), 3) as $productSubcategoryRow)
                <div class="row">
                    @foreach($productSubcategoryRow as $subcategory)
                        <div class="col">
                            <div class="col pl-3 my-3 text-center align-self-center">
                                <h1>{{ $subcategory->name }}</h1>
                                <button type="button" onclick="window.location.href='{{ route('product_subcategories_detail', ['product_category_id' => $product_category->id, 'product_subcategory_id' => $subcategory->id]) }}'" class="btn btn-primary">Ver productos</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
    @include('components.product_category', ['category' => $product_category->products->where('product_subcategory_id', null)])
@endsection