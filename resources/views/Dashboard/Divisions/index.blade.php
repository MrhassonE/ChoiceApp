<x-appDash-layout>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">الشعب<span class="text-muted fw-normal ms-2"> ({{$divisions->count()}})</span></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="d-flex flex-wrap align-items-start justify-content-start gap-2 mb-3">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('division-create'))
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>اضافة شعبة</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row mt-2 d-flex" id="grid-leader">
            @if($divisions)
                @foreach($divisions as $division)
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <img src="{{$division->img_path}}" alt="" style="object-fit: cover;object-position: top" class="avatar-xl img-thumbnail">
                                    </div>
                                    <div class="flex-1 ms-3">
                                        <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">{{$division->name_ar}}</a></h5>
                                    </div>
                                </div>
                                <div class="mt-3 pt-1">
                                    <p class="mb-0 mt-2">
                                        {{$division->title_ar}}</p>
                                </div>
                                <div class="mt-3 pt-1">
                                    <p class="mb-0 mt-2">
                                        {{$division->description_ar}}</p>
                                </div>

                                <div class="d-flex gap-2 pt-4">
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('division-update'))
                                        <a href="{{route('Divisions.edit',$division->id)}}"  class="btn btn-primary btn-sm w-50"><i class="bx bx-pencil me-1"></i> تعديل</a>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('division-delete'))
                                            @if($division->is_active == 1)
                                                <button type="button" onclick="DisActiveDivision({{$division->id}})" class="btn btn-soft-danger btn-sm w-50">ايقاف</button>
                                            @elseif($division->is_active == 0)
                                                <button type="button" onclick="ActiveDivision({{$division->id}})" class="btn btn-soft-success btn-sm w-50">تفعيل</button>
                                            @endif
                                        <button type="button" onclick="deleteLeader({{$division->id}})" class="btn btn-soft-danger btn-sm w-50"><i class="bx bx-trash me-1"></i> حذف</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>

                @endforeach
            @endif
        </div>
        <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">اضافة شعبة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الاسم</label>
                                        <input id="formNameAr" required name="name_ar" type="text" class="form-control" placeholder="الاسم بالعربي">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">Name</label>
                                        <input id="formName" required name="name" type="text" class="form-control" placeholder="Name">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">العنوان</label>
                                        <input id="formJobAr" required name="title_ar" type="text" class="form-control" placeholder="العنوان ">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">Title</label>
                                        <input id="formJob" required name="title" type="text" class="form-control" placeholder="Title">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الوصف</label>
                                        <textarea class="form-control" name="description_ar" id="" cols="20" rows="5"></textarea>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">Description</label>
                                        <textarea class="form-control" name="description" id="" cols="20" rows="5"></textarea>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الصورة</label>
                                        <input name="image" required accept="image/png, image/jpeg, image/jpg"  type="file" class="form-control">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <ul id="errors">

                                    </ul>
                                </div>
                                <div class="col-md-12 my-1">
                                    <button id="submitButton" type="submit" class=" btn btn-primary btn-round">انشاء</button>
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
                    url : '{{route('Divisions.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء الشعبة بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    },
                    error: function (response) {
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
                        if (response.responseJSON.errors.title_ar) {
                            for(let i = 0; i<response.responseJSON.errors.title_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.title_ar[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.name) {
                            for(let i = 0; i<response.responseJSON.errors.name.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.name[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.name_ar) {
                            for(let i = 0; i<response.responseJSON.errors.name_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.name_ar[i]}</li>`
                            }
                        }
                        Swal.fire(
                            'لم يتم اكمال العملية',
                            `هناك خطأ في المدخلات`,
                            'warning'
                        );
                    }
                })
            }
        });
        function deleteLeader(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد حذف هذه الشعبة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url: `/deleteDivisions/${id}`,
                        success: function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الشعبة بنجاح.',
                                'success'
                            ).then((results) => {
                                if (results.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    })
                }
            })
        }

        function ActiveDivision(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد اعاده تفعيل هذه الشعبة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/ActiveDivisions/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم اعاده التفعيل!',
                                'تم اعاده تفعيل الشعبة بنجاح.',
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
        function DisActiveDivision(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد الغاء تفعيل هذه الشعبة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DisActiveDivisions/${id}`,
                        success : function (response) {
                            Swal.fire(
                                'تم الغاء التفعيل!',
                                'تم الغاء تفعيل الشعبة بنجاح.',
                                'success'
                            ).then((results)=>{
                                if (results.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        },
                        error: function () {
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
