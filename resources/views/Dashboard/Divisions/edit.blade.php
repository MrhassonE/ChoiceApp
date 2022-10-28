<x-appDash-layout>
    <div class="container-fluid">
        <form method="post" class="needs-validation" novalidate id="UpdateForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الاسم</label>
                        <input id="formNameAr" value="{{$division->name_ar}}" required name="name_ar" type="text" class="form-control" placeholder="الاسم بالعربي">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group" dir="ltr">
                        <label for="">Name</label>
                        <input id="formName" required name="name" value="{{$division->name}}" type="text" class="form-control" placeholder="Name">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">العنوان </label>
                        <input id="formJobAr" value="{{$division->title_ar}}" required name="title_ar" type="text" class="form-control" placeholder="العنوان">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group" dir="ltr">
                        <label for="">Title</label>
                        <input id="formJob" required name="title" value="{{$division->title}}" type="text" class="form-control" placeholder="Title">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الوصف</label>
                        <textarea class="form-control" name="description_ar" id="" cols="20" rows="5">{{$division->description_ar}}</textarea>
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group" dir="ltr">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" id="" cols="20" rows="5">{{$division->description}}</textarea>
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الصورة</label>
                        <input name="image"  accept="image/png, image/jpeg, image/jpg" type="file" class="form-control">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                    <div class="img-thumbnail my-3" style="width: 150px;">
                        <label for="">الصورة الحالية</label>
                        <img class="img-fluid" src="{{$division->img_path}}">
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
                    url : `/EditDivision/{{$division->id}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل الشعبة بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.replace('{{route('Divisions')}}')
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
