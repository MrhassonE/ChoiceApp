<x-app-dash-layout>
    <div class="container-fluid">
        <form method="post" class="needs-validation" novalidate id="UpdateForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 my-1">
                    <div class="form-group">
                        <label for="">العنوان</label>
                        <input name="title" maxlength="100" value="{{$activity->title}}" type="text" class="form-control">
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-2">
                    <div class="form-group">
                        <label for="">الوصف</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$activity->description}}</textarea>
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الرابط</label>
                        <input name="url" maxlength="190" value="{{$activity->url}}" type="text" class="form-control">
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">الصورة</label>
                        <input name="image" required type="file" accept="image/png, image/jpeg, image/jpg" class="form-control">
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-1">
                    <ul id="errors"></ul>
                </div>
                <div class="col-md-12 my-1">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('activity-update'))
                    <button type="submit" class="btn btn-primary btn-round">تعديل</button>
                    @endif
                    <a href="{{url()->previous()}}" class="btn btn-secondary btn-round">ألغاء</a>
                </div>
            </div>
        </form>
    </div>
    <script >
        let validateForm = true;
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
            if (validateForm !== false) {
                let formData = new FormData($('#UpdateForm')[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url: `{{route('Activity.update',$activity->id)}}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function () {
                        Swal.fire(
                            'تم',
                            'تم التعديل بنجاح',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace('{{route('Department.show',$activity->Department->id)}}')
                            }
                        });
                    },
                    error: function (response) {
                        document.getElementById('errors').innerHTML = '';
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
                        if (response.responseJSON.errors.description) {
                            for(let i = 0; i<response.responseJSON.errors.description.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.description[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.url) {
                            for(let i = 0; i<response.responseJSON.errors.url.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.url[i]}</li>`
                            }
                        }
                        Swal.fire(
                            'لم يتم اكمال العملية',
                            `هناك خطأ في المدخلات`,
                            'warning'
                        )
                    }
                })
            }
        })
    </script>
</x-app-dash-layout>
