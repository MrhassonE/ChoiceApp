<x-appDash-layout>
    <div class="container-fluid">
        <div class="row">
            <h3 class="my-2"> أسم الشركة  {{$company->name}}</h3>
        </div>

        <div class="my-3">
            <a href="{{route('Company')}}" class="btn btn-secondary btn-round"><i class="bx bx-right-arrow-alt me-1"></i>رجوع</a>
        </div>
        <form method="post" class="needs-validation" novalidate id="UpdateForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 my-1">
                    <div class="form-group">
                        <label for="">تقييم الشركة</label>
                        <textarea required class="form-control" name="evaluation" id="evaluation" cols="20" rows="5">{{$company->evaluation}}</textarea>
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
                </div>
            </div>
        </form>

        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('image-create'))
        <div>
            <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary my-4"><i class="bx bx-plus me-1"></i>اضافة صورة</a>
        </div>
        @endif
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">اضافة صورة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 my-1">
                                    <div class="form-group">
                                        <label for="">اختر الصورة</label>
                                        <input name="image" required accept="image/png, image/jpeg, image/jpg"  type="file" class="form-control">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <ul id="errors2">
                                    </ul>
                                </div>
                                <div class="col-md-12 my-1">
                                    <button id="submitButton" type="submit" class=" btn btn-primary btn-round">اضافة</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('image-read'))
        <div class="my-3 row mt-2 d-flex" id="grid-leader">
            @foreach($companyImages as $image)
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{$image->img_path}}" alt="" style="object-fit: cover;object-position: top" class="avatar-xxl img-thumbnail">
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('image-delete'))
                            <div class=" pt-4">
                                <button type="button" onclick="deleteLeader({{$image->id}})" class="btn btn-danger btn-sm w-100"><i class="bx bx-trash me-1"></i> حذف</button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            @endforeach
        </div>
        @endif
    </div>
    <script>
        let validateForm2 = false;
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                            validateForm2 = false;
                        }
                        else {
                            validateForm2 = true;

                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();
        $(`#UpdateForm`).on('submit',function (event) {
            event.preventDefault();
            if (validateForm2 !== false)
            {
                let formData = new FormData($(`#UpdateForm`)[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `/Edit-CompanyEvaluation/{{$company->id}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم تعديل',
                            'تم تعديل تقييم الشركة بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.replace('{{url()->previous()}}')
                        })
                    },
                    error: function (response) {
                        if (response.responseJSON.errors.evaluation) {
                            for(let i = 0; i<response.responseJSON.errors.evaluation.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.evaluation[i]}</li>`
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
        $(`#CreateForm`).on('submit',function (event) {
            event.preventDefault();
            if (validateForm !== false)
            {
                let formData = new FormData($(`#CreateForm`)[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `/storeImage-Company/{{$company->id}}`,
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم اضافة',
                            'تم اضافة صورة للشركة بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.reload()
                        })
                    },
                    error: function (response) {
                        if (response.responseJSON.errors.image) {
                            for(let i = 0; i<response.responseJSON.errors.image.length;i++){
                                document.getElementById('errors2').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.image[i]}</li>`
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
                text: "هل تريد حذف هذه الصورة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url: `/deleteImage-Company/${id}`,
                        success: function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الصورة بنجاح.',
                                'success'
                            ).then((results) => {
                                window.location.reload();
                            })
                        }
                    })
                }
            })
        }
    </script>
</x-appDash-layout>
