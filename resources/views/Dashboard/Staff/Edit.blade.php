<x-app-dash-layout>
    <div class="container-fluid">
        <form action="" id="UpdateForm" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">تغيير معلومات المستخدم</h4>
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
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">رقم الهاتف</label>
                                        <input id="phone" maxlength="15" required name="phone" type="tel" value="{{$user->phone}}" class="form-control" placeholder="ادخل رقم الهاتف">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الورشة</label>
                                        <select name="workshop" required id="workshop" class="form-control">
                                            <option disabled>اختر ورشة</option>
                                            @foreach($workshops as $workshop)
                                                <option value="{{$workshop->id}}" @if($user->Workshop->id == $workshop->id) selected @endif>{{$workshop->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 my-1">
                        <ul id="errors"></ul>
                    </div>

                    <div class="col-md-12 my-1">
                        <button type="submit" id="submitUpdateTwo" onclick="SubmitUpdate({{$user->id}})" class="btn btn-primary btn-round">تعديل</button>
                        <a href="{{url()->previous()}}" class="btn btn-secondary btn-round">ألغاء</a>
                    </div>
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
                            window.location.replace('{{route('Staff')}}')
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
                    if (response.responseJSON.errors.phone) {
                        for(let i = 0; i<response.responseJSON.errors.phone.length;i++){
                            document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.phone[i]}</li>`
                        }
                    }
                    if (response.responseJSON.errors.workshop) {
                        for(let i = 0; i<response.responseJSON.errors.workshop.length;i++){
                            document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.workshop[i]}</li>`
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
