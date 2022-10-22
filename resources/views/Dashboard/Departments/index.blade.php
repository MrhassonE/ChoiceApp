<x-appDash-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">الأقسام</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <div>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('department-create'))
                                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>أضافة قسم</a>
                                        @endif
                                    </div>
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
                                                        <th>القسم</th>
                                                        <th>اللون</th>
                                                        <th>الشعار</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($departments as $key=>$department)
                                                        <tr>
                                                            <td class="fw-semibold">{{$key + 1}}</td>
                                                            <td>
                                                                {{$department->title}}
                                                            </td>
                                                            <td>
                                                                <span style="background: {{$department->color}}; height: 10px; width: 20px" class="badge text-white"> </span>
                                                            </td>
                                                            <td>
                                                                <img src="{{$department->img_path}}" class="rounded-circle avatar img-thumbnail" alt="">
                                                            </td>
                                                            <td>
                                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('department-update'))
                                                                    <button type="button" class="btn btn-dark btn-round">
                                                                        <a href="{{route('Department.show',$department->id)}}" class="text-light" ><i class="fa tui-full-calendar-popup-detail me-1"></i>التفاصيل</a>
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary btn-round">
                                                                        <a href="{{route('Department.edit',$department->id)}}" class="text-light" ><i class="fa fa-pen me-1"></i>تعديل</a>
                                                                    </button>
                                                                @endif
                                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('department-delete'))
                                                                        <button type="button" class="btn btn-danger btn-round">
                                                                            <a href="javascript:;" onclick="DeleteContact({{$department->id}})" class="text-light"><i class="bx bx-trash"></i>حذف</a>
                                                                        </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة قسم</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">اسم القسم</label>
                                    <input id="title" maxlength="100" required name="title" type="text" class="form-control" placeholder="ادخل الاسم">
                                    <div class="invalid-feedback">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-5 my-1">
                                    <div class="form-group">
                                        <label for="">
                                            لون القسم
                                        </label>
                                        <input class="form-control" name="color" type="color" id="color-input-brand">
                                    </div>
                                </div>
                                <div class="col-md-5 my-1">
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
                                    <button id="submitButton" type="submit" class=" btn btn-primary btn-round">أنشاء</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
                    url : '{{route('Department.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء القسم بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    },
                    error : function (response) {
                        if (response.responseJSON.errors.name) {
                            for(let i = 0; i<response.responseJSON.errors.name.length;i++){
                                document.getElementById('feedbackname').innerHTML += `<div class="invalid-feedback d-block" >${response.responseJSON.errors.name[i]}</div>`
                            }
                        }
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
                        if (response.responseJSON.errors.color) {
                            for(let i = 0; i<response.responseJSON.errors.color.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.color[i]}</li>`
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
                text: "هل تريد حذف هذا القسم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DeleteDepartment/${id}`,
                        success : function (response) {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف القسم بنجاح.',
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
