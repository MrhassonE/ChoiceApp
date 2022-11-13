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
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-users-create|country-users-create'))
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
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-users-read'))
                                            <th>الدولة</th>
                                        @endif
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $key=>$user)
                                            <tr>
                                                <td class="fw-semibold">{{$key + 1}}</td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-users-read'))
                                                    <td>
                                                        @if($user->Country)
                                                            {{$user->Country->name}}
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>
                                                    @if($user->id != auth()->id() )
                                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-users-update|country-users-update'))
                                                            @if($user->is_active == 1)
                                                                <a href="{{route('Staff.edit',$user->id)}}" title="تعديل" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                                                <a href="#" data-bs-toggle="modal" title="تغيير الرمز" data-bs-target=".password-{{$user->id}}" class="btn btn-secondary btn-round"><i class="fa fa-user-lock"></i></a>
                                                            @endif
                                                        @endif
                                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-users-delete|country-users-delete'))
                                                                @if($user->is_active == 1)
                                                                        <a href="javascript:;" onclick="DisActiveUser({{$user->id}})" title="أيقاف" class=" btn btn-danger btn-round"><i class="bx bxs-trash"></i></a>
                                                                @elseif($user->is_active == 0)
                                                                    <a href="javascript:;" onclick="ActiveUser({{$user->id}})" class="btn btn-success btn-round">تفعيل</a>
                                                                    <a href="javascript:;" onclick="DeleteContact({{$user->id}})" class="btn btn-danger btn-round"><i class="bx bx-trash"></i>حذف</a>
                                                                @endif
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>

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
                                        <label for="">الرمز</label>
                                        <input id="password" required name="password" minlength="6" maxlength="100" type="password" class="form-control" placeholder="ادخل الرمز">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-users-create'))
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">اختر الدولة</label>
                                        <select name="country" id="" class="form-control">
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                @endif

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
                            window.location.reload();
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
                        window.location.replace('{{route('Staff')}}')
                    });
                },
                error: function (response) {
                    document.getElementById('errors1').innerHTML = '';
                    if (response.responseJSON.errors.passwordEdit) {
                        for(let i = 0; i<response.responseJSON.errors.passwordEdit.length;i++){
                            document.getElementById('errors1').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.passwordEdit[i]}</li>`
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
                                window.location.reload();
                            })
                        }
                    })
                }
            })
        }


        function ActiveUser(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد اعاده تفعيل هذا المستخدم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/ActiveUser/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم اعاده التفعيل!',
                                'تم اعاده تفعيل المستخدم بنجاح.',
                                'success'
                            ).then((results)=>{
                                window.location.reload();
                            })
                        },
                        error: function (response) {
                            swal.hideLoading();
                            Swal.fire(
                                'لم يتم اكمال العملية',
                                `هناك خطأ`,
                                'warning'
                            );
                        }
                    })
                }
            })
        }

        function DisActiveUser(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد الغاء تفعيل هذا المستخدم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DisActiveUser/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الغاء التفعيل!',
                                'تم الغاء تفعيل المستخدم بنجاح.',
                                'success'
                            ).then((results)=>{
                                window.location.reload();
                            })
                        },
                        error: function (response) {
                            swal.hideLoading();
                            Swal.fire(
                                'لم يتم اكمال العملية',
                                `هناك خطأ`,
                                'warning'
                            );
                        }
                    })
                }
            })
        }
    </script>
</x-appDash-layout>
