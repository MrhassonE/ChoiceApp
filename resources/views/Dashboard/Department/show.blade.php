<x-appDash-layout>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">فروع القسم<span class="text-muted fw-normal ms-2"> ({{$department->SubDepartment->count()}})</span></h5>
                </div>
            </div>

            <div class="row">
                <h3 class="my-2">قسم: {{$department->name}}</h3>
            </div>
            <div class="col-md-12">
                <div class="d-flex flex-wrap align-items-center justify-content-start gap-2 mb-3">
                    <div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('sub-department-create'))
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>انشاء فرع</a>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <div>
                            <a href="{{route('Department')}}" class="btn btn-secondary"><i class="fa fa-arrow-circle-right me-1"></i>رجوع</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('sub-department-read'))
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-2 d-flex" id="grid-leader">
                                <div class="table-responsive">
                                    <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>أسم الفرع</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($department->SubDepartment as $key=>$subDep)
                                            <tr>
                                                <td class="fw-semibold">{{$key + 1}}</td>
                                                <td>
                                                    {{$subDep->name}}
                                                </td>
                                                <td>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('sub-department-update'))
                                                        @if($subDep->is_active == 1)
                                                            <a href="{{route('SubDepartment.edit',$subDep->id)}}" title="تعديل" class="mx-2 btn btn-primary btn-round" ><i class="fa fa-pen"></i></a>
                                                        @endif
                                                    @endif
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('sub-department-delete'))
                                                        @if($subDep->is_active == 1)
                                                            <a href="javascript:;" onclick="DisActiveUser({{$subDep->id}})" title="أيقاف الفرع" class="mx-2 btn btn-danger btn-round"><i class="bx bxs-trash"></i></a>
                                                        @elseif($subDep->is_active == 0)
                                                            <a href="javascript:;" onclick="ActiveUser({{$subDep->id}})" class="mx-2 btn btn-success btn-round">تفعيل</a>
                                                            <a href="javascript:;" onclick="DeleteDepartment({{$subDep->id}})" class="mx-2 btn btn-danger btn-round"><i class="bx bx-trash me-1"></i>حذف نهائي</a>
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
        @endif
    <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة فرع</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label for="">اسم الفرع</label>
                                    <input id="name" maxlength="100" required name="name" type="text" class="form-control" placeholder="ادخل الاسم">
                                    <div class="invalid-feedback">
                                        الرجاء املئ الحقل
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            <label class="form-check-label" for="notification">أرسال أشعار</label>
                                            <input class="form-check-input" name="notification" type="checkbox" id="notification" checked="">
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
                    url : '{{route('SubDepartment.store',$department->id)}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء فرع بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.reload();
                        })
                    },
                    error : function (response) {
                        document.getElementById('errors').innerHTML = '';
                        if (response.responseJSON.errors.name) {
                            for(let i = 0; i<response.responseJSON.errors.name.length;i++){
                                document.getElementById('errors').innerHTML += `<div class="invalid-feedback d-block" >${response.responseJSON.errors.name[i]}</div>`
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
                text: "هل تريد اعاده تفعيل هذا الفرع!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/ActiveSubDepartment/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم اعاده التفعيل!',
                                'تم اعاده تفعيل الفرع بنجاح.',
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
                text: "هل تريد الغاء تفعيل هذا الفرع!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DisActiveSubDepartment/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الغاء التفعيل!',
                                'تم الغاء تفعيل الفرع بنجاح.',
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

        function DeleteDepartment(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل تريد حذف هذا الفرع؟',
                text: "سيتم حذف  جميع شركات الفرع واعلاناتها !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DeleteSubDepartment/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الفرع بنجاح.',
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
