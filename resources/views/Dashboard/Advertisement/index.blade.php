<x-appDash-layout>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">الأعلانات<span class="text-muted fw-normal ms-2"> ({{$ads->count()}})</span></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="d-flex flex-wrap align-items-start justify-content-start gap-2 mb-3">
                    <div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('advertisement-create'))
                            <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>انشاء اعلان</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('advertisement-read'))
            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".filter" class="btn btn-primary"><i class="bx bx-filter me-1"></i>فرز حسب</a>
                    </div>
                </div>
            </div>
            <div class="modal fade filter" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">فرز حسب</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('Advertisement')}}" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 my-1">
                                        <div class="form-group">
                                            <label class="">الشركة</label>
                                            <select class="form-control" required name="company" id="companyFilter">
                                                <option value="">اختر الشركة</option>
                                                @foreach($companies  as $company)
                                                    <option  value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <button id="submitButton" type="submit" class=" btn btn-primary btn-round">فرز</button>
                                        <button type="reset" onclick="this.closest('form').reset();window.location.replace('{{route('Advertisement')}}')" class="btn btn-primary">عرض الكل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="row mt-2 d-flex" id="grid-leader">
                @foreach($ads as $ad)
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <img src="{{$ad->img_path}}" alt="" style="object-fit: cover;object-position: top" class="avatar-xxl img-thumbnail">
                                    </div>
                                </div>
                                <div class="mt-3 pt-1">
                                    <p class="mb-0 mt-2 text-black">
                                        الشركة: {{$ad->Company->name}}
                                    </p>
                                </div>
                                <div class="d-flex gap-2 pt-4">
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('advertisement-update'))
                                        <a href="{{route('Advertisement.edit',$ad->id)}}"  class="btn btn-primary"><i class="bx bx-pencil me-1"></i> تعديل</a>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('advertisement-delete'))
                                        <a href="javascript:;" onclick="DeleteAdvertisement({{$ad->id}})" class="btn btn-danger btn-round"><i class="bx bx-trash me-1"></i>حذف</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                @endforeach
            </div>
        @endif

    <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة اعلان</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الصورة</label>
                                        <input name="image" required type="file" accept="image/png, image/jpeg, image/jpg" class="form-control">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الشركة</label>
                                        <select class="form-control" required name="company_id" id="company_id">
                                            @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach
                                        </select>
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
                    url : '{{route('Advertisement.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء الأعلان بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    },
                    error : function (response) {
                        document.getElementById('errors').innerHTML = '';
                        if (response.responseJSON.errors.image) {
                            for(let i = 0; i<response.responseJSON.errors.image.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.image[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.company_id) {
                            for(let i = 0; i<response.responseJSON.errors.company_id.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.company_id[i]}</li>`
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

        function DeleteAdvertisement(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد حذف هذا الأعلان!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DeleteAdvertisement/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الأعلان بنجاح.',
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
