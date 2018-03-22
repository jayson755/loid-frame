<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--[if lt IE 9]>
        <meta http-equiv="refresh" content="0;ie.html" />
        <![endif]-->
        
        <link href="{{asset_site($base_resource, 'css', 'bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset_site($base_resource, 'css', 'font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset_site($base_resource, 'css', 'animate.min.css')}}" rel="stylesheet">
        <link href="{{asset_site($base_resource, 'css', 'admin.min.css')}}" rel="stylesheet">
        <link href="{{asset_site($base_resource, 'css', 'style.min.css')}}" rel="stylesheet">
        <link href="{{asset_site($base_resource, 'plugin', 'toastr/toastr.min.css')}}" rel="stylesheet">
        <link href="{{asset_site($base_resource, 'plugin', 'awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
        @yield('css')
    </head>
    <body class="gray-bg">
        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')
        </div>
    </body>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'loid.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'jquery.form.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'metisMenu/jquery.metisMenu.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'layer-v2.4/layer.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'laydate-v1.1/laydate.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'hplus.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'contabs.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'pace/pace.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'toastr/toastr.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'admin.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'content.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('js')
</html>