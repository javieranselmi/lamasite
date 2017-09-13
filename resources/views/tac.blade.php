@extends('layouts.authentication.layout')

@section('title', 'Terminos y Condiciones')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-8 p-4 mt-3" style="background: rgba(255,255,255,0.7); overflow-x: hidden;">
                {!! $texts->where('name', 'terminos-condiciones')->first()->content !!}
            </div>
        </div>
        <div class="row other-links-row">
            <div class="col-sm-12">
                <div class="other-links-container">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('tac_save') }}">ACEPTAR</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('logout') }}">CANCELAR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
@endsection