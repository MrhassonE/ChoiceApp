<x-appDash-layout>
    <div class="container-fluid">

        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">الأشعارات<span class="text-muted fw-normal ms-2"> ({{$customNotifications->count()}})</span></h5>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('notification-create'))
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>أضافة أشعار</a>
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
                                        <th>العنوان</th>
                                        <th>الوصف</th>
                                        <th>تابع الى</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customNotifications as $key=>$customNotification)
                                            <tr>
                                                <td class="fw-semibold">{{$key + 1}}</td>
                                                <td>
                                                    {{$customNotification->title}}
                                                </td>
                                                <td>
                                                    {{$customNotification->body}}
                                                </td>

                                                <td>
                                                    @if($customNotification->type ==1)
                                                        قسم
                                                    {{$customNotification->Department->name}}
                                                    @elseif($customNotification->type ==2)
                                                        شركو
                                                    {{$customNotification->Company->name}}
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

        <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة أشعار</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 my-1">
                                    <div class="form-group">
                                        <label for="">العنوان</label>
                                        <input type="text" maxlength="100" name="title" required class="form-control" id="">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-1">
                                    <div class="form-group">
                                        <label for="">الوصف</label>
                                        <textarea name="body" maxlength="500" required class="form-control" cols="10" rows="3"></textarea>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">اختر النوع</label>
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="0" readonly>اختر النوع</option>
                                            <option value="1">الاقسام</option>
                                            <option value="2">الشركات</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>

                                <div id="Departments" class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">اختر القسم</label>
                                        <select class="form-control" name="department">
                                            @foreach($deps as $dep)
                                                <option value="{{$dep->id}}">{{$dep->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>

                                <div id="Companies" class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">اختر الشركة</label>
                                        <select class="form-control" name="company">
                                            @foreach($cos as $co)
                                                <option value="{{$co->id}}">{{$co->name}}</option>
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

        <!--  Extra Large modal example -->
    </div>
    <script>
        $('#Companies').hide();
        $('#Departments').hide();
        $(function () {
            $("#type").change(function () {
                if ($(this).val() == "1") {
                    $("#Departments").show();
                    $('#Companies').hide();

                } else if ($(this).val() == "2") {
                    $("#Companies").show();
                    $('#Departments').hide();

                }else if ($(this).val() == "0") {
                    $("#Companies").hide();
                    $('#Departments').hide();
                }
            });
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
                    url : '{{route('CustomNotification.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء أشعار بنجاح',
                            'success'
                        ).then((result)=>{
                            window.location.reload();
                        })
                    },
                    error: function (response) {
                        if (response.responseJSON.errors.title) {
                            for(let i = 0; i<response.responseJSON.errors.title.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.title[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.body) {
                            for(let i = 0; i<response.responseJSON.errors.body.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.body[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.type) {
                            for(let i = 0; i<response.responseJSON.errors.type.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.type[i]}</li>`
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

    </script>
</x-appDash-layout>
