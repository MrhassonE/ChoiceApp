<x-appDash-layout>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">ما الجديد<span class="text-muted fw-normal ms-2"> ({{$news->count()}})</span></h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <div>
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('whats-new-create'))
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>أضافة خبر جديد</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة خبر</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 my-1">
                                <div class="form-group">
                                    <label for="">العنوان</label>
                                    <input id="title" maxlength="100" required name="title" type="text" class="form-control" placeholder="ادخل العنوان">
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
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- end row -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2 d-flex" id="grid-leader">
                            <div class="table-responsive">
                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>العنوان</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($news as $key=>$n)
                                            <tr>
                                                <td class="fw-semibold">{{$key + 1}}</td>
                                                <td>
                                                    {{$n->title}}
                                                </td>
                                                <td>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('whats-new-update'))
                                                            <a href="{{route('WhatsNew.edit',$n->id)}}" class="btn btn-primary btn-round" ><i class="fa fa-pen me-1"></i>تعديل</a>
                                                    @endif
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('whats-new-delete'))
                                                            <a href="javascript:;" onclick="Delete({{$n->id}})" class="btn btn-danger btn-round">حذف</a>
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
                    url : '{{route('WhatsNew.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء الخبر بنجاح',
                            'success'
                        ).then((result)=>{
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    },
                    error : function (response) {
                        if (response.responseJSON.errors.title) {
                            for(let i = 0; i<response.responseJSON.errors.title.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.title[i]}</li>`
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

        function Delete(id) {
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
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/Delete-WhatsNew/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الخبر بنجاح.',
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
