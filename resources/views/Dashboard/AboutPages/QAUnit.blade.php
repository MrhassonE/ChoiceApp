<x-appDash-layout>
    <div class="container-fluid">
        <form method="post" class="needs-validation" novalidate id="UpdateForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">العنوان</label>
                        <input id="title_ar"  value="{{$QAUnit->title_ar}}" required name="title_ar" type="text" class="form-control" placeholder="الاسم بالعربي">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group"  dir="ltr">
                        <label for="">Title</label>
                        <input id="title" required name="title" value="{{$QAUnit->title}}" type="text" class="form-control" placeholder="Name">
                        <div class="invalid-tooltip">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الوصف</label>
                        <textarea name="description_ar" required id="" class="form-control" cols="30" rows="10">{{$QAUnit->description_ar}}</textarea>
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group" dir="ltr">
                        <label for="">Description</label>
                        <textarea name="description" required id="" class="form-control" cols="30" rows="10">{{$QAUnit->description}}</textarea>
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
                    <div class="img-thumbnail my-3 bg-dark" style="width: 100px;">
                        <img class="img-fluid" src="{{$QAUnit->img_path}}" alt="">
                    </div>
                </div>

                <div class="col-md-12 my-1">
                    <ul id="errors">

                    </ul>
                </div>
                <div class="col-md-12 my-1">
                    <button type="submit" class="btn btn-primary btn-round">تعديل</button>
                    <a href="{{route('About')}}" class="btn btn-secondary btn-round">ألغاء</a>
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
                    url : `{{route('About.updateQAUnit')}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل المعلومات بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.replace('{{route('About')}}')
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
                        if (response.responseJSON.errors.description) {
                            for(let i = 0; i<response.responseJSON.errors.description.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.description[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.description_ar) {
                            for(let i = 0; i<response.responseJSON.errors.description_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.description_ar[i]}</li>`
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
