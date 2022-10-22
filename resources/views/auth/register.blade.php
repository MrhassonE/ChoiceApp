<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Choice App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assetsDashboard/images/favicon.ico')}}">
    <!-- Bootstrap Css -->
    <link href="{{asset('assetsDashboard/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assetsDashboard/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assetsDashboard/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
</head>
<body>

<!-- <body data-layout="horizontal"> -->

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay bg-light"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5>! مرحبا بك</h5>
                                <p class="text-muted">أنشاء حساب <br> </p>
                            </div>
                            <div class="p-2 mt-4">
                                <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                                <form role="form" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="name">الأسم</label>
                                        <div class="position-relative input-custom-icon">
                                            <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-lg @if($errors->name->count() > 0) is-invalid @endif" placeholder="ادخل الأسم الثلاثي" aria-label="name">
                                            <span class="bx bx-user"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="username">البريد الألكتروني</label>
                                        <div class="position-relative input-custom-icon">
                                            <input type="email" name="email" class="form-control form-control-lg @if($errors->email->count() > 0) is-invalid @endif" placeholder="ادخل البريد الألكتروني" aria-label="Email">
                                            <span class="bx bx-user"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">الرمز</label>
                                        <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                            <span class="bx bx-lock-alt"></span>
                                            <input type="password" name="password" class="form-control form-control-lg" placeholder="ادخل الرمز" aria-label="Password">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation-input">تأكيد الرمز</label>
                                        <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                            <span class="bx bx-lock-alt"></span>
                                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="ادخل الرمز للتأكيد" aria-label="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn form-control btn-primary w-100 waves-effect waves-light" type="submit">أنشاء الحساب</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div><!-- end container -->
</div>
<!-- end authentication section -->

<!-- JAVASCRIPT -->
<script src="{{asset('assetsDashboard/js/pages/pass-addon.init.js')}}"></script>

</body>
</html>



