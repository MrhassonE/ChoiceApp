<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ mix('laratrust.css', 'vendor/laratrust') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <link href="{{asset('assetsDashboard/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{asset('assetsDashboard/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
    <link href="{{asset('assetsDashboard/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="layout-wrapper">
    <!-- Overlay For Sidebars -->
    @include('.Dashboard.layouts.navigation')
    <?php $title = "Hello" ?>

    @include('.Dashboard.layouts.Sidebar',['title' => 'Hello'])
    <div class="main-content">
        <div class="page-content" style="padding-top: 100px">
            @foreach (['error', 'warning', 'success'] as $msg)
                @if(Session::has('laratrust-' . $msg))
                    <div class="alert-{{ $msg }}" role="alert">
                        <p>{{ Session::get('laratrust-' . $msg) }}</p>
                    </div>
                @endif
            @endforeach
            @yield('content')
        </div>
    </div>
    <a href="#" data-bs-toggle="modal" data-bs-target=".support"
       style="background:#213A75;padding: 20px;font-size: 20px;position: fixed; opacity: 0.8; bottom: 30px;left: 20px;color: #fff;border-radius: 50%;z-index: 10000;"
       class="d-flex justify-content-center">
        <i class="fa fa-headset" aria-hidden="true"></i>
    </a>

    <div class="modal fade support" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">للتواصل مع فريق الدعم الفني</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 my-1">
                            <div class="form-group text-md-center">
                                <h4 class="text-dark"> 07838255584 <i class="fa fa-phone-alt"></i></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 my-1">

                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="{{asset('assetsDashboard/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assetsDashboard/libs/metismenujs/metismenujs.min.js')}}"></script>
    <script src="{{asset('assetsDashboard/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assetsDashboard/libs/eva-icons/eva.min.js')}}"></script>

    <script src="{{asset('assetsDashboard/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>

    <script src="{{asset('assetsDashboard/js/app.js')}}"></script>
    <!-- Theme scripts -->
</div>
</body>
</html>

