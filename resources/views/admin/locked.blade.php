<!DOCTYPE html>
<html lang="en">
<head>
    <title>Locked</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/bootstrap.css?1422792965" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/materialadmin.css?1425466319" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/font-awesome.min.css?1422529194" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/theme-default/material-design-iconic-font.min.css?1421434286" />
    <link type="text/css" rel="stylesheet" href="/style/admin/css/toastr.min.css" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/style/admin/js/libs/utils/html5shiv.js?1403934957"></script>
    <script type="text/javascript" src="/style/admin/js/libs/utils/respond.min.js?1403934956"></script>
    <![endif]-->
</head>
<body class="menubar-hoverable header-fixed ">
<?php $user = \Illuminate\Support\Facades\Auth::user();?>
<section class="section-account">
    <div class="img-backdrop" style="background-image: url('/style/admin/img/img16.jpg')"></div>
    <div class="spacer"></div>
    <div class="card contain-xs style-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <img class="img-circle" src="/style/admin/img/avatar1.jpg?1403934956" alt="" />
                    <h2>{{$user['name']}}</h2>
                    <form class="form" action="{{route('plug.lock',$user['id'])}}"  method="post">
                        {{csrf_field()}}
                        <div class="form-group floating-label">
                            <div class="input-group">
                                <div class="input-group-content">
                                    <input type="password" id="password" class="form-control" name="password">
                                    <label for="password">密码</label>
                                </div>
                                <div class="input-group-btn">
                                    <button class="btn btn-floating-action btn-primary" type="submit"><i class="fa fa-unlock"></i></button>
                                </div>
                            </div><!--end .input-group -->
                        </div><!--end .form-group -->
                    </form>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>
<!-- END LOCKED SECTION -->

<!-- BEGIN JAVASCRIPT -->
<script src="/style/admin/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="/style/admin/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="/style/admin/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="/style/admin/js/libs/spin.js/spin.min.js"></script>
<script src="/style/admin/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="/style/admin/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="/style/admin/js/core/source/App.js"></script>
<script src="/style/admin/js/core/source/AppNavigation.js"></script>
<script src="/style/admin/js/core/source/AppOffcanvas.js"></script>
<script src="/style/admin/js/core/source/AppCard.js"></script>
<script src="/style/admin/js/core/source/AppForm.js"></script>
<script src="/style/admin/js/core/source/AppNavSearch.js"></script>
<script src="/style/admin/js/core/source/AppVendor.js"></script>
<script src="/style/admin/js/core/demo/Demo.js"></script>
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
</body>
</html>
