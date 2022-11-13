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
                        <input id="address" maxlength="100" value="{{$company->address}}" required name="address" type="text" class="form-control" placeholder="العنوان">
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
                <div class="col-md-3 my-1">
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
                <div class="col-md-3 my-1">
                    <div class="form-group">
                        <label for="">الفرع</label>
                        <select class="form-control" required name="sub_department_id" id="subDepartment">
                            @foreach($company->Department->SubDepartment as $subDep)
                                <option @if( $company->SubDepartment->id == $subDep->id) selected @endif value="{{$subDep->id}}">{{$subDep->name}}</option>
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
                <div class="row">
                    <div class="col-md-6 my-1">
                        <div class="form-group">
                            <label for="">تقييم الشركة</label>
                            <textarea class="form-control" name="evaluation" id="evaluation" cols="20" rows="5">{{$company->evaluation}}</textarea>
                            <div class="invalid-tooltip">
                                الرجاء املئ الحقل
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 my-1">
                        <div class="form-group">
                            <label for="">عدد المنتجات</label>
                            <input name="products" min="0" required class="form-control" value="{{$company->products}}" type="number"  id="products">
                            <div class="invalid-tooltip">
                                الرجاء املئ الحقل
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">خط العرض</label>
                            <input name="latitude" class="form-control" value="{{$company->latitude}}" type="text"  id="latitude">
                            <div class="invalid-tooltip">
                                الرجاء املئ الحقل
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 my-1">
                        <div class="form-group">
                            <label for="">عدد الخدمات</label>
                            <input name="services" min="0" required class="form-control" value="{{$company->services}}" type="number"  id="services">
                            <div class="invalid-tooltip">
                                الرجاء املئ الحقل
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">خط الطول</label>
                            <input name="longitude" class="form-control" value="{{$company->longitude}}" type="text"  id="longitude">
                            <div class="invalid-tooltip">
                                الرجاء املئ الحقل
                            </div>
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
        $('select[name="department_id"]').on('change', function (e) {
            var catId = e.target.value;
            if (catId) {
                $.ajax({
                    url: '/subDepartment/' + catId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="sub_department_id"]').empty();
                        $.each(data,function(index,subDep){
                            $('select[name="sub_department_id"]').append('<option value ="'+subDep.id+'">'+subDep.name+'</option>');
                        });
                    }
                })
            }
        });

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
                            window.location.replace('{{route('Company')}}')

                        })
                    },
                    error : function (response) {
                        document.getElementById('errors').innerHTML = '';
                        if (response.responseJSON.errors.name) {
                            for(let i = 0; i<response.responseJSON.errors.name.length;i++){
                                document.getElementById('errors').innerHTML += `<div class="invalid-feedback d-block" >${response.responseJSON.errors.name[i]}</div>`
                            }
                        }
                        if (response.responseJSON.errors.address) {
                            for(let i = 0; i<response.responseJSON.errors.address.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.address[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.phone) {
                            for(let i = 0; i<response.responseJSON.errors.phone.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.phone[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.email) {
                            for(let i = 0; i<response.responseJSON.errors.email.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.email[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.image) {
                            for(let i = 0; i<response.responseJSON.errors.image.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.image[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.facebook) {
                            for(let i = 0; i<response.responseJSON.errors.facebook.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.facebook[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.instagram) {
                            for(let i = 0; i<response.responseJSON.errors.instagram.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.instagram[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.telegram) {
                            for(let i = 0; i<response.responseJSON.errors.telegram.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.telegram[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.whatsapp) {
                            for(let i = 0; i<response.responseJSON.errors.whatsapp.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.whatsapp[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.department_id) {
                            for(let i = 0; i<response.responseJSON.errors.department_id.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.department_id[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.evaluation) {
                            for(let i = 0; i<response.responseJSON.errors.evaluation.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.evaluation[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.products) {
                            for(let i = 0; i<response.responseJSON.errors.products.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.products[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.services) {
                            for(let i = 0; i<response.responseJSON.errors.services.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.services[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.longitude) {
                            for(let i = 0; i<response.responseJSON.errors.longitude.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.longitude[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.latitude) {
                            for(let i = 0; i<response.responseJSON.errors.latitude.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.latitude[i]}</li>`
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
