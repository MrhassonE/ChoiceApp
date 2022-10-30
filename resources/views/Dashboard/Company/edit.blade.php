<x-appDash-layout>
    <div class="container-fluid">
        <form method="post" class="needs-validation" novalidate id="UpdateForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الاسم</label>
                        <input id="name" maxlength="100" value="{{$company->name}}" required name="name" type="text" class="form-control" placeholder="ادخل الاسم">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">العنوان </label>
                        <input id="address" value="{{$company->address}}" required name="address" type="text" class="form-control" placeholder="العنوان">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الريد الالكتروني</label>
                        <input id="email" maxlength="100" required name="email" value="{{$company->email}}" type="email" class="form-control" placeholder="ادخل الريد الالكتروني">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group" >
                        <label for="">رقم الهاتف</label>
                        <input id="phone" required maxlength="20" name="phone" value="{{$company->phone}}" type="text" class="form-control" placeholder="ادخل رقم الهاتف">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">القسم</label>
                        <select class="form-control" required name="department_id" id="department_id">
                            @foreach($departments as $department)
                                <option @if( $company->Department->id == $department->id) selected @endif value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الصورة</label>
                        <input name="image" accept="image/png, image/jpeg, image/jpg" type="file" class="form-control">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                    <div class="img-thumbnail my-3" style="width: 150px;">
                        <label for="">الصورة الحالية</label>
                        <img class="img-fluid" src="{{$company->img_path}}">
                    </div>
                </div>

                <label class="my-3" for="">روابط مواقع التواصل الاجتماعي</label>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الفيسبوك</label>
                        <input id="facebook" value="{{$company->facebook}}" name="facebook" type="text" class="form-control" placeholder="ادخل رابط الفيسبوك">
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الانستاغرام</label>
                        <input id="instagram" value="{{$company->instagram}}" name="instagram" type="text" class="form-control" placeholder="ادخل رابط الانستاغرام">
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">التليجرام</label>
                        <input id="telegram" value="{{$company->telegram}}" name="telegram" type="text" class="form-control" placeholder="ادخل رابط التليجرام">
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">رقم الواتساب</label>
                        <input id="whatsapp" value="{{$company->whatsapp}}" name="whatsapp" type="text" class="form-control" placeholder="ادخل رقم الواتساب">
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>

                <div class="col-md-12 my-1">
                    <ul id="errors">
                    </ul>
                </div>
                <div class="col-md-12 my-1">
                    <button type="submit" class="btn btn-primary btn-round">تعديل</button>
                    <a href="{{url()->previous()}}" class="btn btn-secondary btn-round">ألغاء</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        let validateForm = false;
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
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
        $(`#UpdateForm`).on('submit',function (event) {
            event.preventDefault();
            if (validateForm !== false)
            {
                let formData = new FormData($(`#UpdateForm`)[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `/Edit-Company/{{$company->id}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل الشركة بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.replace('{{url()->previous()}}')
                            }
                        })
                    },
                    error: function (response) {
                        if (response.responseJSON.errors.image) {
                            for(let i = 0; i<response.responseJSON.errors.image.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.image[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.title) {
                            for(let i = 0; i<response.responseJSON.errors.title.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.title[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.title_ar) {
                            for(let i = 0; i<response.responseJSON.errors.title_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.title_ar[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.name) {
                            for(let i = 0; i<response.responseJSON.errors.name.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.name[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.name_ar) {
                            for(let i = 0; i<response.responseJSON.errors.name_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.name_ar[i]}</li>`
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
