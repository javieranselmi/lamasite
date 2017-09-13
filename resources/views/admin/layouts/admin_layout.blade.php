<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>NutriSite Admin - @yield('title')</title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_assets/js/fancybox/jquery.fancybox.css') }}" type="text/css" media="screen" />

        <!-- page specific plugin styles -->

        @yield('custom_css')

        <style type="text/css">
            .vakata-context {
                z-index: 9999 !important;
            }
        </style>

        <!-- text fonts -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/fonts.googleapis.com.css') }}" />

        <!-- ace styles -->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('admin_assets/css/ace-skins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('admin_assets/css/ace-rtl.min.css') }}" />

        <!--[if lte IE 9]>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/ace-ie.min.css') }}" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="{{ asset('admin_assets/js/ace-extra.min.js') }}"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="{{ asset('admin_assets/js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/respond.min.js') }}"></script>
        <![endif]-->

        <link rel="stylesheet" href="{{ asset('admin_assets/css/animate.css') }}" />



    </head>

    <body class="no-skin">
        @if(!isset($iframe))
            @include('admin.layouts.admin_navigation')
        @endif

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

            <div id="sidebar" class="sidebar responsive ace-save-state">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

                @if(!isset($iframe))
                    @include('admin.layouts.admin_menu')
                @endif

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    @yield('content')
                </div>
            </div><!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            <span class="blue bolder">Nutricia</span>
                             Admin &copy; 2017
                        </span>
                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="{{ asset('admin_assets/js/jquery-2.1.4.min.js') }}"></script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="{{ asset('admin_assets/js/jquery-1.11.3.min.js') }}"></script>
        <![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>

        <!-- page specific plugin scripts -->

        <!-- ace scripts -->
        <script src="{{ asset('admin_assets/js/ace-elements.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/ace.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('admin_assets/js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/fancybox/jquery.fancybox.pack.js') }}"></script>
        <script src="{{ asset('admin_assets/js/jquery.form.min.js') }}"></script>

        <script src="{{ asset('admin_assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/dataTables.select.min.js') }}"></script>

        <script src="{{ asset('admin_assets/js/helpers.js') }}"></script>
        <script src="{{ asset('js/laroute.js') }}"></script>


        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>

        @yield('custom_script')

    </body>
</html>
