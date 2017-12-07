<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('view.title')}}</title>

    <meta name="keywords" content="{{config('view.title')}}">
    <meta name="description" content="{{config('view.title')}}">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    
    <link href="{{asset_site($base_resource, 'css', 'bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset_site($base_resource, 'css', 'font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset_site($base_resource, 'css', 'animate.min.css')}}" rel="stylesheet">
    <link href="{{asset_site($base_resource, 'css', 'admin.min.css')}}" rel="stylesheet">
    <link href="{{asset_site($base_resource, 'css', 'style.min.css')}}" rel="stylesheet">
    <link href="{{asset_site($base_resource, 'plugin', 'toastr/toastr.min.css')}}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        @include($view_base_prefix . '/left')
        <!--左侧导航结束-->
        
        
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            
            <!--右侧顶部开始-->
            @include($view_base_prefix . '/top')
            <!--右侧顶部结束-->
            
            <!--tab标签条开始-->
            @include($view_base_prefix . '/tab')
            <!--tab标签结束-->
            
            @yield('content')
            
            <div class="footer" id="right_footer">
                <!--尾部开始-->
                @include($view_base_prefix . '/footer')
                <!--尾部结束-->
            </div>
        </div>
        <!--右侧部分结束-->
        
        <!--右侧边栏开始-->
        @include($view_base_prefix . '/sidebar')
        <!--右侧边栏结束-->
    </div>
    
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'loid.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'jquery.form.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'metisMenu/jquery.metisMenu.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'layer-v2.4/layer.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'hplus.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'js', 'contabs.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'pace/pace.min.js')}}"></script>
    <script type='text/javascript' src="{{asset_site($base_resource, 'plugin', 'toastr/toastr.min.js')}}"></script>
</body>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function(){
    //工作区域高度自定义
    $("#content-main").height($(window).outerHeight() - $("#right_top").outerHeight() - $("#right_tab").outerHeight() - $("#right_footer").outerHeight());
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    $(".J_logout").click(function(){
        var login_load = layer.load();
        $.ajax({
            url:"{{route('manage.logout')}}",
            type:"post",
            dataType:"json",
            success:function(){
                layer.close(login_load);
                window.location.href="{{route('login')}}";
            },
            error:function(){
                layer.close(login_load);
                _toastr('网络错误', 'error');
            }
        });
    });
    $(".J_clearCache").click(function(){
        var login_load = layer.load();
        $.ajax({
            url:"{{route('manage.clear')}}",
            type:"post",
            dataType:"json",
            success:function(){
                layer.close(login_load);
                _toastr('已删除系统缓存');
            },
            error:function(){
                layer.close(login_load);
                _toastr('网络错误', 'error');
            }
        });
    });
});
function _toastr(message, type, title) {
    switch (type) {
        case 'warning':
            title = title ? title : '警告提示'; 
            toastr.warning(message, title);
            break;
        case 'info':
            title = title ? title : '消息提示'; 
            toastr.info(message, title);
            break;
        case 'error':
            title = title ? title : '错误提示'; 
            toastr.error(message, title);
            break;
        default:
            title = title ? title : '成功提示'; 
            toastr.success(message, title);
            break;
    }
    
}

/*图片上传*/
function _inputchanges(self, object){
	var tmp_name = self.attr('name');
    var upload_after = self.attr('_data_after_fuc');
	var myform = document.createElement("form");
    myform.action = self.attr('_data_action');
	myform.method = "post";
	myform.enctype = "multipart/form-data";
	myform.style.display = "none";
    
    var fileNameInput = document.createElement("input"); 
    fileNameInput.type = "hidden"; 
    fileNameInput.name = "fileName"; 
    fileNameInput.value = tmp_name;
    myform.appendChild(fileNameInput);
    var fileDistrictInput = document.createElement("input"); 
    fileDistrictInput.type = "hidden";
    fileDistrictInput.name = "fileDistrict"; 
    fileDistrictInput.value = self.attr('_data_fileDistrict');
    myform.appendChild(fileDistrictInput);
    
	document.body.appendChild(myform);  //创建表单后一定要加上这句否则得到的form不能上传。document后要加上body,否则火狐下不行。
	var form = $(myform);
	var clone = self.clone();
	clone.val("");
	self.parent().append(clone);
	clone.bind("change",function(){
		var self = $(this);
		_inputchanges(self, object);
	});
	var fu1 = self.appendTo(form);
    
    var img_upload_load = layer.load();
	form.ajaxSubmit({
		success: function (data) {
			layer.close(img_upload_load);
            object.upload_after(data);
		},error:function(){
            layer.close(img_upload_load);
            _toastr('error', '错误提示', '网络错误');
        }
	})
}
</script>
</html>