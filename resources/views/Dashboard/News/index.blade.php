<x-appDash-layout>
    <div class="container-fluid">

        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">الأخبار<span class="text-muted fw-normal ms-2"> ({{$news->count()}})</span></h5>
                </div>
            </div>

            <div class="col-md-12">
                <div class="d-flex flex-wrap align-items-center justify-content-start gap-2 mb-3">
                    <div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('news-create'))
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>انشاء</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row mt-2 d-flex" id="grid-leader">
            @foreach($news as $new)
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <img src="{{$new->img_path}}" alt="" style="object-fit: cover;object-position: top" class="avatar-lg rounded-circle img-thumbnail">
                                </div>
                            </div>
                            <div class="mt-3 pt-1">
                                <h5 class=" font-size-16 text-dark mb-0 mt-2">
                                    {{$new->title}}</h5>
                            </div>
                            <div class="mt-3 pt-1">
                                <p class="mb-0 mt-2">
                                    {{$new->description}}</p>
                            </div>
                            <div class="mt-3 pt-1">
                                <p class="mb-0 ">
                                    {{$new->url}}</p>
                            </div>
                            <div class="d-flex gap-2 pt-4">
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('news-delete'))
                                <button type="button" onclick="DeleteContact({{$new->id}})" class="btn btn-soft-danger btn-sm w-50"><i class="bx bx-trash me-1"></i> حذف</button>
                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('news-update'))
                                <a href="{{route('News.edit',$new->id)}}"  class="btn btn-primary btn-sm w-50"><i class="bx bx-pencil me-1"></i> تعديل</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>

            @endforeach
        </div>

        <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة خبر</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 my-1">
                                    <div class="form-group">
                                        <label for="">العنوان</label>
                                        <input id="formTitle" maxlength="100" required name="title" type="text" class="form-control" placeholder="ادخل العنوان">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <div class="form-group">
                                        <label for="">الوصف</label>
                                        <textarea name="description" id="" class="form-control" cols="30" rows="10"></textarea>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الرابط</label>
                                        <input id="formUrl" maxlength="190" name="url" type="text" class="form-control" placeholder="رابط">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الصورة</label>
                                        <input name="image"  type="file" accept="image/png, image/jpeg, image/jpg" class="form-control">
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

        <!--  Extra Large modal example -->
    </div>
    <script >

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
                        if (response.responseJSON.errors.description) {
                            for(let i = 0; i<response.responseJSON.errors.description.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.description[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.url) {
                            for(let i = 0; i<response.responseJSON.errors.url.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.url[i]}</li>`
                            }
                        }
                        swal.hideLoading();
                        Swal.fire(
                            'لم يتم اكمال العملية',
                            `هناك خطأ في المدخلات`,
                            'warning'
                        );
                        // console.log(response.responseJSON.errors.name)
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
                        url : `/DeleteNews/${id}`,
                        success : function (response) {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الخبر بنجاح.',
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
