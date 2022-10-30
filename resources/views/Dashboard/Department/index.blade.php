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
                                                        <th>المدينة</th>
                                                        <th>الشعار</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($departments as $key=>$department)
                                                        <tr>
                                                            <td class="fw-semibold">{{$key + 1}}</td>
                                                            <td>
                                                                {{$department->name}}
                                                            </td>
                                                            <td>
                                                                {{$department->City->name}}
                                                            </td>
                                                            <td>
                                                                <img src="{{$department->img_path}}" class=" avatar img-thumbnail" alt="">
                                                            </td>
                                                            <td>
                                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('department-update'))
                                                                    @if($department->is_active == 1)
{{--                                                                        <a href="{{route('Department.show',$department->id)}}" class="btn btn-secondary btn-round" >التفاصيل</a>--}}
                                                                        <a href="{{route('Department.edit',$department->id)}}" class="btn btn-primary btn-round" ><i class="fa fa-pen me-1"></i>تعديل</a>
                                                                    @endif
                                                                @endif
                                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('department-delete'))
                                                                    @if($department->is_active == 1)
                                                                        <a href="javascript:;" onclick="DisActiveUser({{$department->id}})" class="btn btn-danger btn-round">ايقاف</a>
                                                                    @elseif($department->is_active == 0)
                                                                        <a href="javascript:;" onclick="ActiveUser({{$department->id}})" class="btn btn-success btn-round">تفعيل</a>
                                                                        <a href="javascript:;" onclick="DeleteDepartment({{$department->id}})" class="btn btn-danger btn-round"><i class="bx bx-trash me-1"></i>حذف نهائي</a>
                                                                    @endif
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
                                    <input id="name" maxlength="100" required name="name" type="text" class="form-control" placeholder="ادخل الاسم">
                                    <div class="invalid-feedback">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-5 my-1">
                                    <div class="form-group">
                                        <label for="">الصورة</label>
                                        <input name="image" required type="file" accept="image/png, image/jpeg, image/jpg" class="form-control">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 my-1">
                                    <div class="form-group">
                                        <label for="">المدينة</label>
                                        <select class="form-control"  required name="city_id" id="city_id">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
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
                                document.getElementById('errors').innerHTML += `<div class="text-danger" >${response.responseJSON.errors.name[i]}</div>`
                            }
                        }
                        if (response.responseJSON.errors.city_id) {
                            for(let i = 0; i<response.responseJSON.errors.city_id.length;i++){
                                document.getElementById('errors').innerHTML += `<div class="text-danger" >${response.responseJSON.errors.city_id[i]}</div>`
                            }
                        }
                        document.getElementById('errors').innerHTML = '';
                        if (response.responseJSON.errors.image) {
                            for(let i = 0; i<response.responseJSON.errors.image.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.image[i]}</li>`
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
                text: "هل تريد اعاده تفعيل هذا القسم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/ActiveDepartment/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم اعاده التفعيل!',
                                'تم اعاده تفعيل القسم بنجاح.',
                                'success'
                            ).then((results)=>{
                                if (results.isConfirmed) {
                                    window.location.reload();
                                }
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
                text: "هل تريد الغاء تفعيل هذا القسم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DisActiveDepartment/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الغاء التفعيل!',
                                'تم الغاء تفعيل القسم بنجاح.',
                                'success'
                            ).then((results)=>{
                                if (results.isConfirmed) {
                                    window.location.reload();
                                }
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

        function DeleteDepartment(id) {
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
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DeleteDepartment/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف القسم بنجاح.',
                                'success'
                            ).then((results)=>{
                                if (results.isConfirmed) {
                                    window.location.reload();
                                }
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
