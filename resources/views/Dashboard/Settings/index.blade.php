<x-appDash-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">معلومات المكتب</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" class="needs-validation" novalidate id="infoForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">اسم المكتب</label>
                                        <input id="company_name_ar" maxlength="500" value="{{$setting_info->company_name_ar}}" required name="company_name_ar" type="text" class="form-control" placeholder="ادخل الاسم">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Office Name</label>
                                        <input id="company_name" maxlength="500" value="{{$setting_info->company_name}}" required name="company_name" type="text" class="form-control" placeholder="Enter Name">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" >
                                    <div class="form-group">
                                        <label for="">Slogan (Ar)</label>
                                        <input id="slogan_ar" maxlength="500" value="{{$setting_info->slogan_ar}}" required name="slogan_ar" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Slogan (En)</label>
                                        <input id="slogan" maxlength="500" value="{{$setting_info->slogan}}" required name="slogan" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">شعار المكتب</label>
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
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">البريد الالكتروني </label>
                                        <input id="email" value="{{$contact->email}}" required name="email" type="email" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">رقم الهاتف</label>
                                        <input id="phone" value="{{$contact->phone}}" maxlength="15" required name="phone" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">العنوان</label>
                                        <input id="formNameAr" value="{{$contact->address_ar}}" required name="address_ar" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input id="formNameAr" value="{{$contact->address}}" required name="address" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1" >
                                    <div class="form-group" dir="ltr">
                                        <label for="">Location</label>
                                        <textarea name="location" id="" cols="20" class="form-control" rows="5">{{$contact->location}}</textarea>
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">facebook</label>
                                        <input id="formNameAr" value="{{$contact->facebook}}"  name="facebook" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">instagram</label>
                                        <input id="formNameAr" value="{{$contact->instagram}}"  name="instagram" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" >
                                    <div class="form-group"  dir="ltr">
                                        <label for="">telegram</label>
                                        <input id="formNameAr" value="{{$contact->telegram}}"  name="telegram" type="text" class="form-control" placeholder="">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" >
                                    <div class="form-group" dir="ltr">
                                        <label for="">youtube</label>
                                        <input id="formNameAr" value="{{$contact->youtube}}"  name="youtube" type="text" class="form-control" placeholder="">
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
                            if (result.isConfirmed) {
                                window.location.replace('{{route('Setting')}}')
                            }
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
                        if (response.responseJSON.errors.company_name_ar) {
                            for(let i = 0; i<response.responseJSON.errors.company_name_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.company_name_ar[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.slogan) {
                            for(let i = 0; i<response.responseJSON.errors.slogan.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.slogan[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.slogan_ar) {
                            for(let i = 0; i<response.responseJSON.errors.slogan_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.slogan_ar[i]}</li>`
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
                            if (result.isConfirmed) {
                                window.location.replace('{{route('Setting')}}')
                            }
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
        })

    </script>
</x-appDash-layout>
