<x-appDash-layout>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">الاخبار<span class="text-muted fw-normal ms-2"> ({{$news->count()}})</span></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="d-flex flex-wrap align-items-start justify-content-start gap-2 mb-3">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('news-create'))
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>اضافة خبر</a>
                    </div>
                    @endif
                </div>
            </div>
{{--            <div class="d-flex flex-wrap gap-2 mb-3">--}}
{{--                <div>--}}
{{--                    <a href="#" data-bs-toggle="modal" data-bs-target=".filter" class="btn btn-primary"><i class="bx bx-filter me-1"></i>فرز حسب</a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!-- end row -->

        <div class="row mt-2 d-flex" id="grid-leader">
            @if($news)
                @foreach($news as $new)
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="modal fade filter" tabindex="-1" role="dialog" aria-labelledby="LargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="LargeModalLabel">فرز حسب</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('News')}}" method="get" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12 my-1">
                                                            <div class="row my-3 ">
                                                                <label for="">فرز حسب تاريخ الزيارة</label>
                                                                <div class="col-md-4 my-1">
                                                                    <div class="form-group">
                                                                        <label for="">التاريخ من</label>
                                                                        <input id="start" required name="start" type="text" class="form-control" placeholder="ادخل التاريخ من">
                                                                        <div class="invalid-feedback">
                                                                            الرجاء املئ الحقل
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 my-1">
                                                                    <div class="form-group">
                                                                        <label for="">التاريخ الى</label>
                                                                        <input id="end" required name="end" type="text" class="form-control" placeholder="ادخل التاريخ الى">
                                                                        <div class="invalid-feedback">
                                                                            الرجاء املئ الحقل
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 my-1">
                                                            <button id="submitButton" type="submit" class=" btn btn-primary btn-round">فرز</button>
                                                            <button type="reset" onclick="this.closest('form').reset();window.location.replace('{{route('News')}}')" class="btn btn-primary">عرض الكل</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->


                                <div class="d-flex align-items-center">
                                    <div>
                                        <img src="{{$new->img_path}}" alt="" style="object-fit: cover;object-position: top" class="avatar-xl img-thumbnail">
                                    </div>
                                </div>
                                <div class="mt-3 pt-1">
                                    <h5 class="font-size-16 mb-1 mt-2 text-dark">
                                        {{$new->title_ar}}
                                    </h5>
                                </div>
                                <div class="mt-3 pt-1">
                                    <p class="mb-0 mt-2">
                                        {{$new->description_ar}}
                                    </p>
                                </div>

                                <div class="d-flex gap-2 pt-4">
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('news-update'))
                                    <a href="{{route('News.edit',$new->id)}}"  class="btn btn-primary btn-sm w-50"><i class="bx bx-pencil me-1"></i> تعديل</a>
                                    <a href="{{route('News.show',$new->id)}}"  class="btn btn-secondary btn-sm w-50"><i class="bx bx-plus-circle me-1"></i>اضافة صور </a>
                                    @endif
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('news-delete'))
                                    <button type="button" onclick="deleteLeader({{$new->id}})" class="btn btn-soft-danger btn-sm w-50"><i class="bx bx-trash me-1"></i> حذف</button>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">اضافة خبر</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">العنوان</label>
                                        <input id="formNameAr" required name="title_ar" type="text" class="form-control" placeholder="">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">Title</label>
                                        <input id="formName" required name="title" type="text" class="form-control" placeholder="title">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الوصف</label>
                                        <textarea name="description_ar" required class="form-control" id="" cols="20" rows="5"></textarea>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group" dir="ltr">
                                        <label for="">Description</label>
                                        <textarea name="description" required class="form-control" id="" cols="20" rows="5"></textarea>
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
        flatpickr('#start', {
            onChange: function () {
                flatpickr('#end', {
                    minDate: document.getElementById('start').value
                })
            }
        });
        flatpickr('#end', {
            onChange: function () {
                flatpickr('#start', {
                    maxDate: document.getElementById('end').value
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
                    url : '{{route('News.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء خبر بنجاح',
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
                        if (response.responseJSON.errors.description) {
                            for(let i = 0; i<response.responseJSON.errors.description.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.description[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.description_ar) {
                            for(let i = 0; i<response.responseJSON.errors.description_ar.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.description_ar[i]}</li>`
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
                text: "هل تريد حذف هذا الخبر!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url: `/deleteNews/${id}`,
                        success: function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الخبر بنجاح.',
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

    </script>
</x-appDash-layout>
