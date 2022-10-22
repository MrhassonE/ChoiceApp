<x-appDash-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">معلومات الشركة</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" class="needs-validation" novalidate id="infoForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 my-1">
                                    <div class="form-group">
                                        <label for="">اسم الشركة</label>
                                        <input id="company_name" maxlength="100" value="{{$settings->company_name}}" required name="company_name" type="text" class="form-control" placeholder="ادخل الاسم">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-1" >
                                    <div class="form-group">
                                        <label for="">خط العرض</label>
                                        <input id="latitude" value="{{$settings->latitude}}" required name="latitude" type="text" class="form-control">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 my-1" >
                                    <div class="form-group">
                                        <label for="">خط الطول</label>
                                        <input id="longitude" value="{{$settings->longitude}}" required name="longitude" type="text" class="form-control">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1">
                                    <div class="form-group">
                                        <label for="">شعار الشركة</label>
                                        <input name="company_logo"  type="file" accept="image/png, image/jpeg, image/jpg" class="form-control">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                    <div class="img-thumbnail my-3 bg-dark" style="width: 200px;">
                                        <img class="img-fluid" src="{{$settings->img_path}}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-3 my-1" >
                                    <div class="form-group">
                                        <label for="">موقع الرسمي للشركة</label>
                                        <input id="url" maxlength="190" value="{{$settings->url}}" name="url" type="text" class="form-control">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <ul id="errors"></ul>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('general_setting-update'))
                                    <div class="col-md-12 my-1">
                                        <button type="submit" class="btn btn-primary btn-round">تعديل</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">أنواع الخدمات في التطبيق</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mt-2 d-flex" id="grid-leader">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>الخدمة</th>
                                                        <th>اللون</th>
                                                        <th>الشعار</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($serviceTypes as $key=>$serviceType)
                                                        <tr>
                                                            <td class="fw-semibold">{{$key + 1}}</td>
                                                            <td>
                                                                {{$serviceType->title}}
                                                            </td>
                                                            <td>
                                                                <span style="background: {{$serviceType->color}}; height: 10px; width: 20px" class="badge text-white"> </span>
                                                            </td>
                                                            <td>
                                                                <img src="{{$serviceType->img_path}}" class="rounded-circle avatar img-thumbnail" alt="">
                                                            </td>
                                                            <td>
                                                                <a href="{{route('ServiceType.edit',$serviceType->id)}}" class="text-primary" ><i class="fa fa-pen me-1"></i></a>
{{--                                                                <a href="javascript:;" onclick="DeleteContact({{$serviceType->id}})" class="text-danger"><i class="bx bx-trash"></i></a>--}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">معلومات البريد الالكتروني</h3>
                </div>
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate id="emailForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 my-1">
                                <div class="form-group" dir="ltr">
                                    <label for="">Driver</label>
                                    <input id="formNameAr" value="{{$email->driver}}" required name="driver" type="text" class="form-control" placeholder="">
                                    <div class="invalid-tooltip">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-1" dir="ltr">
                                <div class="form-group">
                                    <label for="">Host</label>
                                    <input id="formNameAr" value="{{$email->host}}" required name="host" type="text" class="form-control" placeholder="">
                                    <div class="invalid-tooltip">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-1" dir="ltr">
                                <div class="form-group">
                                    <label for="">Port</label>
                                    <input id="formNameAr" value="{{$email->port}}" required name="port" type="text" class="form-control" placeholder="">
                                    <div class="invalid-tooltip">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-1" dir="ltr">
                                <div class="form-group">
                                    <label for="">Encryption</label>
                                    <input id="formNameAr" value="{{$email->encryption}}" required name="encryption" type="text" class="form-control" placeholder="">
                                    <div class="invalid-tooltip">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-1" dir="ltr">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input id="formNameAr" value="{{$email->username}}" required name="username" type="email" class="form-control" placeholder="">
                                    <div class="invalid-tooltip">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 my-1" dir="ltr">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input id="formNameAr" value="" required name="password" type="password" class="form-control" placeholder="">
                                    <div class="invalid-tooltip">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 my-1">
                                <ul id="errors1"></ul>
                            </div>
                            <div class="col-md-12 my-1">
                                <button type="submit" class="btn btn-primary btn-round">تعديل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        let validateForm = false;
        (function () {
            'use strict';
            const forms = document.querySelectorAll('#infoForm');
            Array.from(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                            validateForm = false;
                        }
                        else {
                            validateForm = true;
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();
        $(`#infoForm`).on('submit',function (event) {
            event.preventDefault();
            if (validateForm !== false)
            {
                let formData = new FormData($(`#infoForm`)[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `{{route('Setting.update')}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function (response) {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل المعلومات بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.replace('{{route('Setting')}}')
                            }
                        })
                    },
                    error: function (response) {
                        document.getElementById('errors').innerHTML = '';
                        if (response.responseJSON.errors.company_name) {
                            for(let i = 0; i<response.responseJSON.errors.company_name.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.company_name[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.company_logo) {
                            for(let i = 0; i<response.responseJSON.errors.company_logo.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.company_logo[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.url) {
                            for(let i = 0; i<response.responseJSON.errors.url.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.url[i]}</li>`
                            }
                        }
                        swal.hideLoading();
                        Swal.fire(
                            'لم يتم اكمال العملية',
                            `هناك خطأ في المدخلات`,
                            'warning'
                        );
                    }
                })
            }
        });
        let validateFormEmail = false;
        (function () {
            'use strict';
            const forms = document.querySelectorAll('#emailForm');
            Array.from(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                            validateFormEmail = false;
                        }
                        else {
                            validateFormEmail = true;

                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();
        $(`#emailForm`).on('submit',function (event) {
            event.preventDefault();
            if (validateFormEmail !== false)
            {
                let formData = new FormData($(`#emailForm`)[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `{{route('Setting.email')}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function (response) {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل معلومات البريد الالكتروني بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.replace('{{route('Setting')}}')
                            }
                        })
                    },
                    error: function (response) {
                        document.getElementById('errors1').innerHTML = '';
                        if (response.responseJSON.errors.driver) {
                            for(let i = 0; i<response.responseJSON.errors.driver.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.driver[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.host) {
                            for(let i = 0; i<response.responseJSON.errors.host.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.host[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.port) {
                            for(let i = 0; i<response.responseJSON.errors.port.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.port[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.username) {
                            for(let i = 0; i<response.responseJSON.errors.username.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.username[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.password) {
                            for(let i = 0; i<response.responseJSON.errors.password.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.password[i]}</li>`
                            }
                        }
                        swal.hideLoading();
                        Swal.fire(
                            'لم يتم اكمال العملية',
                            `هناك خطأ في المدخلات`,
                            'warning'
                        );
                    }
                })
            }
        })

    </script>
</x-appDash-layout>
