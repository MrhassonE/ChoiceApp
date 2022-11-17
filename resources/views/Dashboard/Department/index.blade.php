<x-appDash-layout>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">الأقسام<span class="text-muted fw-normal ms-2"> ({{$departments->count()}})</span></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="d-flex flex-wrap align-items-start justify-content-start gap-2 mb-3">
                    <div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-department-create|country-department-create'))
                            <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>أضافة قسم</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
                        <form action="{{route('Department')}}" method="get" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 my-1">
                                    <div class="form-group">
                                        <label class="">المدينة</label>
                                        <select class="form-control" name="city" id="cityFilter">
                                            <option value="">اختر المدينة</option>
                                            @foreach($cities  as $city)
                                                <option @if(request()->city == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <button id="submitButton" type="submit" class=" btn btn-primary btn-round">فرز</button>
                                    <button type="reset" onclick="this.closest('form').reset();window.location.replace('{{route('Department')}}')" class="btn btn-primary">عرض الكل</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

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
                                        <th>الشعار</th>
                                        <th>القسم</th>
                                        <th>المدينة</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departments as $key=>$department)
                                        <tr>
                                            <td class="fw-semibold">{{$key + 1}}</td>
                                            <td>
                                                <img src="{{$department->img_path}}" class=" avatar img-thumbnail" alt="">
                                            </td>
                                            <td>
                                                {{$department->name}}
                                            </td>
                                            <td>
                                                {{$department->City->name}}
                                            </td>
                                            <td>
                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-department-update|country-department-update'))
                                                    @if($department->is_active == 1)
                                                        @if($department->is_main ==0)
                                                            <a href="javascript:;" onclick="MainSection({{$department->id}})" title="اضافة الى الواجهة الرئيسية" class="mx-2 btn btn-soft-primary btn-round"><i class="fa fa-solid fa-plus"></i></a>
                                                        @elseif($department->is_main ==1)
                                                            <a href="javascript:;" onclick="MainSection({{$department->id}})" title="اخفاء من الواجهة الرئيسية" class="mx-2 btn btn-soft-danger btn-round"><i class="fa fa-solid fa-trash-alt"></i></a>
                                                        @endif
                                                        <a href="{{route('Department.show',$department->id)}}" title="عرض الفروع" class="mx-2 btn btn-secondary btn-round" ><i class="fa fa-eye"></i></a>
                                                        <a href="{{route('Department.edit',$department->id)}}" title="تعديل" class="mx-2 btn btn-primary btn-round" ><i class="fa fa-pen"></i></a>
                                                    @endif

                                                @endif
                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-department-delete|country-department-delete'))
                                                    @if($department->is_active == 1)
                                                        <a href="javascript:;" onclick="DisActiveUser({{$department->id}})" title="أيقاف القسم" class="mx-2 btn btn-danger btn-round"><i class="bx bxs-trash"></i></a>
                                                    @elseif($department->is_active == 0)
                                                        <a href="javascript:;" onclick="ActiveUser({{$department->id}})" class="mx-2 btn btn-success btn-round">تفعيل</a>
                                                        <a href="javascript:;" onclick="DeleteDepartment({{$department->id}})" class="mx-2 btn btn-danger btn-round"><i class="bx bx-trash me-1"></i>حذف نهائي</a>
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
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-department-create'))
                                    <div class="col-md-3 my-1">
                                        <div class="form-group">
                                            <label for="">الدولة</label>
                                            <select class="form-control" required name="Country">
                                                <option disabled selected value="0">اختيار الدولة</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 my-1">
                                        <div class="form-group">
                                            <label for="">المدينة</label>
                                            <select class="form-control" required name="City">
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                @else
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
                                @endif
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
        $(document).ready(function () {
            $('select[name="Country"]').on('change', function (e) {
                var catId = e.target.value;
                if (catId) {
                    $.ajax({
                        url: '/coCitiesSuper/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="City"]').empty();
                            $('select[name="City"]').append('<option disabled selected value="0">اختر المدينة</option>');
                            $.each(data,function(index,city){
                                $('select[name="City"]').append('<option value ="'+city.id+'">'+city.name+'</option>');
                            });
                        }
                    })
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
                            window.location.reload();
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
                title: 'هل تريد حذف هذا القسم؟',
                text: "سيتم حذف  جميع شركات القسم واعلاناتها !",
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

        function MainSection(id) {
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url : `/MainSection-Department/${id}`,
                success : function (response) {
                    Swal.fire(
                        response.title,
                        response.desc,
                        'success'
                    ).then((results)=>{
                        window.location.reload();
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
    </script>
</x-appDash-layout>
