<x-app-dash-layout>
    <div class="container-fluid">
        <form action="" id="UpdateForm" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">الحساب الشخصي</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الاسم</label>
                                        <input id="formName" maxlength="100" required name="name" value="{{$user->name}}" type="text" class="form-control" placeholder="ادخل الاسم">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">البريد الالكتروني</label>
                                        <input id="email" maxlength="100" required name="email" type="email" value="{{$user->email}}" class="form-control" placeholder="ادخل البريد الالكتروني">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('profile-update'))
                <div class="col-md-2 mt-5">
                    <div class="card">
                        <a href="#" data-bs-toggle="modal" data-bs-target=".password-{{$user->id}}" class="btn btn-primary">تغيير الرمز</a>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12 my-1">
                        <ul id="errors"></ul>
                    </div>
                    <div class="col-md-12 my-1">
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('profile-update'))
                        <button type="button" id="submitUpdateTwo" onclick="SubmitUpdate({{$user->id}})" class="btn btn-primary btn-round">تعديل</button>
                        @endif
                        <a href="{{url()->previous()}}" class="btn btn-secondary btn-round">ألغاء</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--  Extra Large modal example -->
    <div class="modal fade password-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">تغير الرمز</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" class="needs-validation" novalidate id="EditPassword-{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">الرمز</label>
                                    <input id="passwordEdit" maxlength="100" required name="passwordEdit" type="text" class="form-control" placeholder="ادخل الرمز">
                                    <div class="invalid-feedback">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 my-1">
                                <ul id="errors1"></ul>
                            </div>
                            <div class="col-md-12 my-3">
                                <button type="button" id="submitUpdate" onclick="ChangePassword({{$user->id}})" class="btn btn-primary btn-round">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--  Extra Large modal example -->
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
        function SubmitUpdate(id) {
            event.preventDefault();
            let formData = new FormData($('#UpdateForm')[0]);
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url: `/Edit-Staff/${id}`,
                data: formData,
                contentType:false,
                processData:false,
                success : function () {
                    Swal.fire(
                        'تم',
                        'تم التعديل بنجاح',
                        'success'
                    ).then((result)=>{
                        if(result.isConfirmed) {
                            window.location.replace('{{route('Dashboard')}}')
                        }
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
        function ChangePassword(id) {
            event.preventDefault();
            let formData = new FormData($(`#EditPassword-${id}`)[0]);
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url: `/Staff-ChangePassword/${id}`,
                data: formData,
                contentType:false,
                processData:false,
                success : function () {
                    Swal.fire(
                        'تم',
                        'تم تغيير الرمز بنجاح',
                        'success'
                    ).then((result)=>{
                        if(result.isConfirmed) {
                            window.location.replace('{{route('Dashboard')}}')
                        }
                    });
                },
                error: function (response) {
                    document.getElementById('errors1').innerHTML = '';
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
    </script>
</x-app-dash-layout>
