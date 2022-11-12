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
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">اسم الشركة</label>
                                        <input id="company_name" maxlength="500" value="{{$setting_info->company_name}}" required name="company_name" type="text" class="form-control" placeholder="ادخل الاسم">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">شعار الشركة</label>
                                        <input name="company_logo" accept="image/png, image/jpeg, image/jpg"   type="file" class="form-control">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                    <div class="img-thumbnail my-3 bg-dark" style="width: 100px;">
                                        <img class="img-fluid" src="{{$setting_info->company_logo_path}}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <ul id="errors">

                                    </ul>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">معلومات التواصل</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" class="needs-validation"  novalidate id="contactForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 my-1">
                                    <div class="form-group">
                                        <label for="">البريد الالكتروني </label>
                                        <input id="email" value="{{$setting_info->email}}" required name="email" type="email" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1">
                                    <div class="form-group">
                                        <label for="">رقم الهاتف</label>
                                        <input id="phone" value="{{$setting_info->phone}}" maxlength="15" required name="phone" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1">
                                    <div class="form-group">
                                        <label for="">رقم الهاتف 2</label>
                                        <input id="phone2" value="{{$setting_info->phone2}}" maxlength="15" name="phone2" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">Facebook</label>
                                        <input id="facebook" value="{{$setting_info->facebook}}"  name="facebook" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">Instagram</label>
                                        <input id="instagram" value="{{$setting_info->instagram}}"  name="instagram" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" >
                                    <div class="form-group"  dir="ltr">
                                        <label for="">Telegram</label>
                                        <input id="telegram" value="{{$setting_info->telegram}}"  name="telegram" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" >
                                    <div class="form-group" dir="ltr">
                                        <label for="">WhatsApp</label>
                                        <input id="whatsapp" value="{{$setting_info->whatsapp}}"  name="whatsapp" type="text" class="form-control" >
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 my-1">
                                    <ul id="errors1">

                                    </ul>
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
                                        <input id="driver" value="{{$email->driver}}" required name="driver" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Host</label>
                                        <input id="host" value="{{$email->host}}" required name="host" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Port</label>
                                        <input id="port" value="{{$email->port}}" required name="port" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Encryption</label>
                                        <input id="encryption" value="{{$email->encryption}}" required name="encryption" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input id="username" value="{{$email->username}}" required name="username" type="email" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input id="password" value="" required name="password" type="password" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <ul id="errors2"></ul>
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
                    url : `{{route('Setting.info')}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل المعلومات بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.replace('{{route('Setting')}}')
                        })
                    },
                    error: function (response) {
                        if (response.responseJSON.errors.company_logo) {
                            for(let i = 0; i<response.responseJSON.errors.company_logo.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.company_logo[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.company_name) {
                            for(let i = 0; i<response.responseJSON.errors.company_name.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.company_name[i]}</li>`
                            }
                        }
                        Swal.fire(
                            'لم يتم اكمال العملية',
                            `هناك خطأ في المدخلات`,
                            'warning'
                        );
                    }
                })
            }
        });
        let validateFormContact = false;
        (function () {
            'use strict';
            const forms = document.querySelectorAll('#contactForm');
            Array.from(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                            validateFormContact = false;
                        }
                        else {
                            validateFormContact = true;

                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();
        $(`#contactForm`).on('submit',function (event) {
            event.preventDefault();
            if (validateFormContact !== false)
            {
                let formData = new FormData($(`#contactForm`)[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `{{route('Setting.contact')}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل معلومات التواصل بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.replace('{{route('Setting')}}')
                        })
                    },
                    error: function (response) {
                        if (response.responseJSON.errors.email) {
                            for(let i = 0; i<response.responseJSON.errors.email.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.email[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.phone) {
                            for(let i = 0; i<response.responseJSON.errors.phone.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.phone[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.address) {
                            for(let i = 0; i<response.responseJSON.errors.address.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.address[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.address_ar) {
                            for(let i = 0; i<response.responseJSON.errors.address_ar.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.address_ar[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.location) {
                            for(let i = 0; i<response.responseJSON.errors.location.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.location[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.facebook) {
                            for(let i = 0; i<response.responseJSON.errors.facebook.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.facebook[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.instagram) {
                            for(let i = 0; i<response.responseJSON.errors.instagram.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.instagram[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.telegram) {
                            for(let i = 0; i<response.responseJSON.errors.telegram.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.telegram[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.youtube) {
                            for(let i = 0; i<response.responseJSON.errors.youtube.length;i++){
                                document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.youtube[i]}</li>`
                            }
                        }
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
                            window.location.replace('{{route('Setting')}}')
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
