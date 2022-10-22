<x-appDash-layout>
    <div class="container-fluid">

        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">المستخدمين<span class="text-muted fw-normal ms-2"> ({{$users->count()}})</span></h5>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('users-create'))
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>أضافة مستخدم</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2 d-flex" id="grid-leader">
                            <div class="table-responsive">
                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الأسم</th>
                                        <th>البريد الالكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>الورشة</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $key=>$user)
                                            @if($user->id != \Illuminate\Support\Facades\Auth::id())
                                            <tr>
                                                <td class="fw-semibold">{{$key + 1}}</td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    {{$user->phone}}
                                                </td>
                                                <td>
                                                    @if($user->Workshop)
                                                        {{$user->Workshop->name}}
                                                        @else
                                                        الورشة محذوفة
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('users-update'))
                                                    <a href="{{route('Staff.edit',$user->id)}}" class="text-primary" ><i class="fa fa-pen me-1"></i></a>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target=".password-{{$user->id}}" class="text-secondary"><i class="fa fa-user-lock m-2"></i></a>
                                                    @endif
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('users-delete'))
                                                    <a href="javascript:;" onclick="DeleteContact({{$user->id}})" class="text-danger"><i class="bx bx-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                            <!--  Extra Large modal example -->
                                            <div class="modal fade password-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myExtraLargeModalLabel">تغير رمز {{$user->name}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" class="needs-validation" novalidate id="EditPassword-{{$user->id}}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-6 my-1">
                                                                        <div class="form-group">
                                                                            <label for="">الرمز</label>
                                                                            <input id="passwordEdit" required name="passwordEdit" type="text" class="form-control" placeholder="ادخل الرمز">
                                                                            <div class="invalid-feedback">
                                                                                الرجاء املئ الحقل
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 my-1">
                                                                        <ul id="errors1"></ul>
                                                                    </div>
                                                                    <div class="col-md-12 my-3">
                                                                        <button type="button" id="submitUpdateTwo" onclick="SubmitUpdate({{$user->id}})" class="btn btn-primary btn-round">حفظ</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            <!--  Extra Large modal example -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة مستخدم</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الاسم</label>
                                        <input id="formName" required name="name" maxlength="100" type="text" class="form-control" placeholder="ادخل الاسم">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">البريد الالكتروني</label>
                                        <input id="email" required name="email" maxlength="100" type="email" class="form-control" placeholder="ادخل البريد الالكتروني">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">رقم الهاتف</label>
                                        <input id="phone" required name="phone" maxlength="15" type="tel" class="form-control" placeholder="ادخل رقم الهاتف">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الرمز</label>
                                        <input id="password" required name="password" minlength="6" maxlength="100" type="password" class="form-control" placeholder="ادخل الرمز">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الورشة</label>
                                        <select name="workshop" required id="workshop" class="form-control">
                                            @foreach($workshops as $workshop)
                                                <option value="{{$workshop->id}}">{{$workshop->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">تحديد الدور</label>
                                        <select name="role" required id="role" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <ul id="errors"></ul>
                                </div>
                                <div class="col-md-12 my-3">
                                    <button id="submitButton" type="submit" class=" btn btn-primary btn-round">أنشاء</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!--  Extra Large modal example -->
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
                            console.log(validateForm)
                        }
                        else {
                            validateForm = true;
                            console.log(validateForm)

                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();
        $("#CreateForm").on('submit',function (event) {
            event.preventDefault();
            if (validateForm === true)
            {
                let formData = new FormData($('#CreateForm')[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : '{{route('Staff.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء المستخدم بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
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
                        if (response.responseJSON.errors.password) {
                            for(let i = 0; i<response.responseJSON.errors.password.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.password[i]}</li>`
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
                        if (response.responseJSON.errors.role) {
                            for(let i = 0; i<response.responseJSON.errors.role.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.role[i]}</li>`
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
         function SubmitUpdate(id) {
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
                            window.location.replace('{{route('Staff')}}')
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

        function DeleteContact(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد حذف هذا المستخدم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DeleteUser/${id}`,
                        success : function (response) {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف المستخدم بنجاح.',
                                'success'
                            ).then((results)=>{
                                if (results.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    })
                }
            })
        }
    </script>
</x-appDash-layout>
