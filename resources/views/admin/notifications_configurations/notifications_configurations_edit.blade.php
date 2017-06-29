@extends('admin.layouts.admin_layout')

@section('title', 'Editar Configuracion Notificaciones')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/chosen.min.css') }}" />
@endsection

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Notifications</a>
            </li>

            <li class="">
                <a href="#">Administrar Configuracion</a>
            </li>
            <li class="active">Editar</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Editar Configuracion Notificaciones
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                {!! Form::open(['route' => 'admin_notification_configuration_edit_post', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                    @if (isset($failed))
                        <div class="alert alert-danger">
                            Hubo errores en la edicion. Por favor intente nuevamente.
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    @endif

                    @foreach($notification_configuration as $configuration)
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="{{ $configuration->name }}"> {{ $configuration->display_name }} </label>

                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input name="{{ $configuration->name }}" id="{{ $configuration->name }}" type="checkbox" class="ace" value="1" {{ $configuration->value ? "checked" : "" }}>
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach



                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Guardar
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection


@section('custom_script')
    <script src="{{ asset('admin_assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/ace.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/autosize.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin_assets/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            @if (isset($message) && isset($status))
                notification('{{ $status }}', '{{ $message }}');
            @endif
        });
    </script>
@endsection