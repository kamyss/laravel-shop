<?php
$user = \Illuminate\Support\Facades\Auth::user();
$route =  Route::currentRouteName();
$model = new \App\User();
$model->check($user['id'],$route);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="keywords">
    <meta name="description" content="xxx admin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/bootstrap.css?1422792965" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/materialadmin.css?1425466319" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/font-awesome.min.css?1422529194" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/material-design-iconic-font.min.css?1421434286" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/libs/rickshaw/rickshaw.css?1422792967" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/libs/morris/morris.core.css?1420463396" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/bootstrap-table.css" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/toastr.min.css" />
@yield('css')

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/style/admin/js/libs/utils/html5shiv.js?1403934957"></script>
    <script type="text/javascript" src="/style/admin/js/libs/utils/respond.min.js?1403934956"></script>
    <![endif]-->
</head>
<body class="menubar-hoverable header-fixed menubar-pin ">

<!-- 顶部导航开始-->
<header id="header" >
    <div class="headerbar">
        <!-- 手机显示 -->
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand" >
                    <div class="brand-holder">
                        <a href="../../html/dashboards/dashboard.html">
                            <span class="text-lg text-bold text-primary">MATERIAL ADMIN</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- 顶部右侧 -->
        <div class="headerbar-right">
            <ul class="header-nav header-nav-profile">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                        <img src="/style/admin/img/avatar1.jpg?1403934956" alt="" />
                        <span class="profile-info">
									{{$user['name']}}
						</span>
                    </a>
                    <ul class="dropdown-menu animation-dock">
                        <li class="dropdown-header">Config</li>
                        <li><a href="">My profile</a></li>
                        <li class="divider"></li>
                        <li><a href=""><i class="fa fa-fw fa-lock"></i>锁定</a></li>
                        <li><a href=""><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</header>
<!-- 头部结束-->

<!-- 内容开始 -->
<div id="base">
    <div class="offcanvas">
    </div>
    <div id="content">
        <section>
            <div class="section-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ trans($error) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')

            </div>
        </section>
    </div>
    <!-- 内容结束 -->

    <!-- 侧边开始  -->
    <div id="menubar" class="menubar-inverse ">
        <div class="menubar-fixed-panel">
            <div>
                <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="expanded">
                <a href="../../html/dashboards/dashboard.html">
                    <span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
                </a>
            </div>
        </div>
        <div class="menubar-scroll-panel">
            <ul id="main-menu" class="gui-controls">
                <?php $a= new \App\Admin\Models\Menu(); $a->leftMenu();?>
            </ul>
            <div class="menubar-foot-panel">
                <small class="no-linebreak hidden-folded">
                    <span class="opacity-75">Copyright &copy; 2014</span> <strong>CodeCovers</strong>
                </small>
            </div>
        </div>
    </div>
</div>

<script src="/style/admin/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="/style/admin/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="/style/admin/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="/style/admin/js/libs/spin.js/spin.min.js"></script>
<script src="/style/admin/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="/style/admin/js/libs/moment/moment.min.js"></script>
<script src="/style/admin/js/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="/style/admin/js/libs/sparkline/jquery.sparkline.min.js"></script>
<script src="/style/admin/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="/style/admin/js/libs/d3/d3.min.js"></script>
<script src="/style/admin/js/libs/d3/d3.v3.js"></script>
<script src="/style/admin/js/libs/rickshaw/rickshaw.min.js"></script>
<script src="/style/admin/js/core/source/App.js"></script>
<script src="/style/admin/js/core/source/AppNavigation.js"></script>
<script src="/style/admin/js/core/source/AppOffcanvas.js"></script>
<script src="/style/admin/js/core/source/AppCard.js"></script>
<script src="/style/admin/js/core/source/AppForm.js"></script>
<script src="/style/admin/js/core/source/AppNavSearch.js"></script>
<script src="/style/admin/js/core/source/AppVendor.js"></script>
<script src="/style/admin/js/core/source/AppVendor.js"></script>
<script src="/style/admin/js/bootstrap-table.js"></script>
<script src="/style/admin/js/bootstrap-table-demo.min.js"></script>
<script src="/style/admin/js/toastr.min.js"></script>

<script>
            @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
@yield('js')

<!-- END JAVASCRIPT -->

</body>
</html>
