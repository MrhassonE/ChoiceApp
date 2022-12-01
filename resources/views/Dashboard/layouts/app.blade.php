<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
{{--        <link rel="shortcut icon" href="{{asset('assetsDashboard/images/favicon.ico')}}">--}}
        <link rel="shortcut icon" href="{{\App\Models\GeneralSetting::first()->company_logo_path}}" type="image/x-icon">

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{\App\Models\GeneralSetting::first()->company_name}}</title>
        <meta content="{{\App\Models\GeneralSetting::first()->company_name}}" name="description" />
        <!-- Google fonts -->
        <link
            href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Vendors CSS -->
        <link href="{{asset('assetsDashboard/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assetsDashboard/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="{{asset('assetsDashboard/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assetsDashboard/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <script src="{{asset('assetsDashboard/js/plugins/chartjs.min.js')}}"></script>

        <link href="{{asset('assetsDashboard/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

    </head>
    <body >
    <div id="layout-wrapper">
            <!-- Page Content -->
            <div class="page-loader-wrapper">
                <div class="loader">
                    <div class="m-t-30"><img src="{{asset('assetsDashboard/images/logo.svg')}}" width="48" height="48" alt="Alpino"></div>
                    <p>انتضر لحضة ...</p>
                </div>
            </div>
            <!-- Overlay For Sidebars -->
            @include('Dashboard.layouts.navigation')
        <?php $title = "مرحبا" ?>

                @include('Dashboard.layouts.Sidebar',['title' => 'مرحبا'])
            <main>
                <div class="main-content">
                    <div class="page-content pt-3">
                        {{ $slot }}
                    </div>
                </div>
            </main>

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
{{--            <script src="{{asset('assetsDashboard/libs/eva-icons/eva.min.js')}}"></script>--}}
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="{{asset('assetsDashboard/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>

            <script src="{{asset('assetsDashboard/js/app.js')}}"></script>
            <!-- Theme scripts -->
    </div>
    </body>
</html>
