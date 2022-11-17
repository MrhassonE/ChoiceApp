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
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-create|country-advertisement-create'))
                            <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>انشاء اعلان</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-read|country-advertisement-read'))
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
                @if($ads->count()>0)
                    <div class="col-xl-12 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-2 d-flex" id="grid-leader">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الصورة</th>
                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-read'))
                                                    <th>الدولة</th>
                                                @endif
                                                <th>المدينة</th>
                                                <th>أسم الشركة</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ads as $key=>$ad)
                                                <tr>
                                                    <td class="fw-semibold">{{$key + 1}}</td>
                                                    <td>
                                                        <img src="{{$ad->img_path}}" class="avatar-md  card-img-top" alt="">
                                                    </td>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-read'))
                                                        <td>
                                                            {{$ad->Country->name}}
                                                        </td>
                                                    @endif
                                                    <td>
                                                        {{$ad->City->name}}
                                                    </td>
                                                    <td>
                                                        {{$ad->Company->name}}
                                                    </td>
                                                    <td>
                                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-update|country-advertisement-update'))
                                                            <a href="{{route('Advertisement.edit',$ad->id)}}" title="تعديل" class="btn btn-primary"><i class="bx bx-pencil"></i></a>

                                                        @endif
                                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-delete|country-advertisement-delete'))
                                                            <a href="javascript:;" onclick="DeleteAdvertisement({{$ad->id}})" title="حذف" class="btn btn-danger btn-round"><i class="bx bx-trash"></i></a>
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
                        <!-- end card -->
                    </div>
                @else
                    <div class="my-5">
                        <h3 class="text-center">لا يوجد اعلانات</h3>
                    </div>
                @endif
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
                                <div class="col-md-4 my-1">
                                    <div class="form-group">
                                        <label for="">الصورة</label>
                                        <input name="image" required type="file" accept="image/png, image/jpeg, image/jpg" class="form-control">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-create'))
                                    <div class="col-md-2 my-1">
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
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">المدينة</label>
                                            <select class="form-control" required name="City">
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <div class="form-group">
                                            <label for="">الشركة</label>
                                            <select class="form-control" required name="Company">
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">المدينة</label>
                                            <select class="form-control" required name="City">
                                                <option value="0" disabled selected>أختر المدينة</option>
                                                @foreach($countries->City as $city)
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <div class="form-group">
                                            <label for="">الشركة</label>
                                            <select class="form-control" required name="Company">
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                @endif

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
                            $.each(data, function (index, city) {
                                $('select[name="City"]').append('<option value ="' + city.id + '">' + city.name + '</option>');
                            });
                        }
                    })
                }
            });
            $('select[name="City"]').on('change', function (e) {
                var catId = e.target.value;
                if (catId) {
                    $.ajax({
                        url: '/cosFromCitySuper/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Company"]').empty();
                            $.each(data, function (index, city) {
                                $('select[name="Company"]').append('<option value ="' + city.id + '">' + city.name + '</option>');
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
                            window.location.reload();
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
