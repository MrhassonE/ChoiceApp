<x-app-dash-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">تغيير معلومات المستخدم</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" class="needs-validation" novalidate id="infoForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الاسم</label>
                                        <input id="name" maxlength="100" required name="name" value="{{$user->name}}" type="text" class="form-control" placeholder="ادخل الاسم">
                                        <div class="invalid-tooltip">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1" dir="ltr">
                                    <div class="form-group">
                                        <label for="">البريد الالكتروني</label>
                                        <input id="email" maxlength="100" required name="email" type="email" value="{{$user->email}}" class="form-control" placeholder="ادخل البريد الالكتروني">
                                        <div class="invalid-tooltip">
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
                </div>
            </div>
        </div>
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
        $(`#infoForm`).on('submit',function (event) {

            event.preventDefault();
            if (validateForm !== false)
            {
                let formData = new FormData($(`#infoForm`)[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `{{route('Staff.update',$user->id)}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم',
                            'تم التعديل بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.replace('{{route('Staff')}}')
                        });
                    },
                    error: function (response) {
                        document.getElementById('errors').innerHTML = '';
                        if (response.responseJSON.errors.name) {
                            for(let i = 0; i<response.responseJSON.errors.name.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.name[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.email) {
                            for(let i = 0; i<response.responseJSON.errors.email.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.email[i]}</li>`
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
    </script>
</x-app-dash-layout>
