<x-appDash-layout>
    <div class="container-fluid">
        <form method="post" class="needs-validation" novalidate id="UpdateForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">العنوان</label>
                        <textarea name="title_ar" required id="" class="form-control" cols="30" rows="10">{{$service->title_ar}}</textarea>
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="form-group" dir="ltr">
                        <label for="">Title</label>
                        <textarea name="title" required id="" class="form-control" cols="30" rows="10">{{$service->title}}</textarea>
                        <div class="invalid-feedback">
                            الرجاء املئ الحقل
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-1">
                    <ul id="errors"></ul>
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
                    url : `{{route('Services.update',$service->id)}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل الخدمة بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.replace('{{route('Services')}}')
                            }
                        })
                    },
                    error: function (response) {
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
