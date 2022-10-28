<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset('assetsDashboard/images/favicon.ico')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{\App\Models\GeneralSetting::first()->company_name}}</title>
        <meta content="{{\App\Models\GeneralSetting::first()->slogan}}" name="description" />
        <!-- Google fonts -->
        <link
            href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Vendors CSS -->
        <link href="{{asset('assetsDashboard/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assetsDashboard/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="{{asset('assetsDashboard/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assetsDashboard/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
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
                    <p>Please wait...</p>
                </div>
            </div>
            <!-- Overlay For Sidebars -->
            @include('Dashboard.layouts.navigation')
        <?php $title = "Hello" ?>

                @include('Dashboard.layouts.Sidebar',['title' => 'Hello'])
            <main>
                <div class="main-content">
                    <div class="page-content pt-3">
                        {{ $slot }}
                    </div>
                </div>
            </main>
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
