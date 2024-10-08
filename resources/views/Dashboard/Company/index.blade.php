<x-appDash-layout>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">الشركات<span class="text-muted fw-normal ms-2"> ({{$companies->count()}})</span></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" >
                <div class="d-flex flex-wrap align-items-start justify-content-start gap-2 mb-3">
                    <div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-create|country-company-create'))
                            <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>انشاء شركة</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-read|country-company-read'))
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
                            <form action="{{route('Company')}}" method="get" enctype="multipart/form-data">
                                <div class="row">
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-read'))
                                        <div class="col-md-3 my-1">
                                            <div class="form-group">
                                                <label for="">الدولة</label>
                                                <select class="form-control" name="filterCountry">
                                                    <option disabled selected value="0">اختيار الدولة</option>
                                                    @foreach($filterCountries as $country)
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
                                                <select class="form-control" name="filterCity">
                                                </select>
                                                <div class="invalid-feedback">
                                                    الرجاء املئ الحقل
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 my-1">
                                            <div class="form-group">
                                                <label for="">القسم</label>
                                                <select class="form-control" name="filterDep">
                                                </select>
                                                <div class="invalid-feedback">
                                                    الرجاء املئ الحقل
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    <div class="col-md-12 my-1">
                                        <div class="form-group">
                                            <label class="">القسم</label>
                                            <select class="form-control" name="dep" id="depFilter">
                                                <option value="">اختر القسم</option>
                                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-department-read|country-department-read'))
                                                @foreach($departments  as $department)
                                                    <option @if(request()->dep == $department->id) selected @endif value="{{$department->id}}">{{$department->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-3 my-2">
                                        <input name="new" @if(request()->new == 1) checked @endif class="form-check-input" type="checkbox" value="1" >
                                        <label class="form-check-label" for="flexCheckDefault">في قسم الجديد</label>
                                    </div>
                                    <div class="col-md-3 my-2">
                                        <input name="most_viewed" @if(request()->most_viewed == 1) checked @endif class="form-check-input" type="checkbox" value="1">
                                        <label class="form-check-label" for="flexCheckDefault">في قسم الاكثر مشاهدة</label>
                                    </div>
                                    <div class="col-md-3 my-2">
                                        <input name="main" @if(request()->main == 1) checked @endif class="form-check-input" type="checkbox" value="1">
                                        <label class="form-check-label" for="flexCheckDefault">في القائمة الرئيسية</label>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <button id="submitButton" type="submit" class=" btn btn-primary btn-round">فرز</button>
                                        <button type="reset" onclick="this.closest('form').reset();window.location.replace('{{route('Company')}}')" class="btn btn-primary">عرض الكل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2 d-flex" id="grid-leader">
                        @if($companies->count() >0)
                            <div class="table-responsive">
                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الصورة</th>
                                        <th>أسم الشركة</th>
                                        <th>البريد الالكتروني</th>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-read'))
                                            <th>الدولة</th>
                                        @endif
                                        <th>المدينة</th>
                                        <th>القسم</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $key=>$co)
                                        <tr>
                                            <td class="fw-semibold">{{$key + 1}}</td>
                                            <td>
                                                <img src="{{$co->img_path}}" class="avatar  card-img-top" alt="">
                                            </td>
                                            <td>
                                                {{$co->name}}
                                            </td>
                                            <td>
                                                {{$co->email}}
                                            </td>
                                            @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-read'))
                                                <td>
                                                    {{$co->Country->name}}
                                                </td>
                                            @endif
                                            <td>
                                                {{$co->City->name}}
                                            </td>
                                            <td>
                                                {{$co->Department->name}}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 pt-4">
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-update|country-company-update'))
                                                        @if($co->is_active == 1)
                                                            <div class="ms-auto">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-link text-secondary ps-0 pe-2" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v text-lg"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="navbarDropdownMenuLink">
                                                                        <a href="{{route('Company.show',$co->id)}}" class="dropdown-item">معرض الصور</a>
                                                                        @if($co->new ==0)
                                                                            <a href="javascript:;" onclick="NewSection({{$co->id}})" class="dropdown-item">اضافة الى الجديد</a>
                                                                        @elseif($co->new ==1)
                                                                            <a href="javascript:;" onclick="NewSection({{$co->id}})" class="dropdown-item">أخفاء من الجديد</a>
                                                                        @endif
                                                                        @if($co->most_viewed ==0)
                                                                            <a href="javascript:;" onclick="MostViewedSection({{$co->id}})" class="dropdown-item">اضافة الى الأكثر مشاهدة</a>
                                                                        @elseif($co->most_viewed ==1)
                                                                            <a href="javascript:;" onclick="MostViewedSection({{$co->id}})" class="dropdown-item">أخفاء من الأكثر مشاهدة</a>
                                                                        @endif
                                                                        @if($co->is_main ==0)
                                                                            <a href="javascript:;" onclick="MainSection({{$co->id}})" class="dropdown-item">اضافة الى الواجهة الرئيسية</a>
                                                                        @elseif($co->is_main ==1)
                                                                            <a href="javascript:;" onclick="MainSection({{$co->id}})" class="dropdown-item">أخفاء من الواجهة الرئيسية</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="{{route('Company.edit',$co->id)}}" title="تعديل" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                                        @endif
                                                    @endif
                                                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-delete|country-company-delete'))
                                                        @if($co->is_active == 1)
                                                                <a href="javascript:;" onclick="DisActiveUser({{$co->id}})" title="أيقاف" class=" btn btn-danger btn-round"><i class="bx bxs-trash"></i></a>
                                                        @elseif($co->is_active == 0)
                                                            <a href="javascript:;" onclick="ActiveUser({{$co->id}})" class="btn btn-success btn-round">تفعيل</a>
                                                            <a href="javascript:;" onclick="DeleteCompany({{$co->id}})" class="btn btn-danger btn-round"><i class="bx bx-trash me-1"></i>حذف نهائي</a>

                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                        <div class="my-5">
                           <h3 class="text-center">لا يوجد شركات</h3>
                        </div>
                @endif
            </div>
                    </div>
                </div>
            </div>
        @endif

    <!--  Extra Large modal example -->
        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">أضافة شركة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="needs-validation" novalidate id="CreateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الاسم</label>
                                        <input id="name" maxlength="100" required name="name" type="text" class="form-control" placeholder="ادخل الاسم">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">العنوان</label>
                                        <input id="address" maxlength="500" required name="address" type="text" class="form-control" placeholder="ادخل العنوان">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-create'))
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
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">القسم</label>
                                            <select class="form-control" required name="Department">
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">اختر الفرع</label>
                                            <select name="subDepartment" class="form-control">
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">القسم</label>
                                            <select class="form-control" required name="department_id" id="department_id">
                                                    <option value="0" disabled selected>أختر قسم</option>
                                                    @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                    @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">اختر الفرع</label>
                                            <select name="subDepartment_id" class="form-control">
                                            </select>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-4 my-1">
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
                                        <label for="">البريد الالكتروني</label>
                                        <input id="email" maxlength="100" required name="email" type="email" class="form-control" placeholder="ادخل البريد الالكتروني">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">رقم الهاتف</label>
                                        <input id="phone" maxlength="20" required name="phone" type="text" class="form-control" placeholder="ادخل رقم الهاتف">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>

                                <label class="my-3" for="">روابط مواقع التواصل الاجتماعي</label>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الفيسبوك</label>
                                        <input id="facebook"  name="facebook" type="text" class="form-control" placeholder="ادخل رابط الفيسبوك">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الانستاغرام</label>
                                        <input id="instagram"  name="instagram" type="text" class="form-control" placeholder="ادخل رابط الانستاغرام">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">التليجرام</label>
                                        <input id="telegram"  name="telegram" type="text" class="form-control" placeholder="ادخل رابط التليجرام">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <div class="form-group">
                                        <label for="">الواتساب</label>
                                        <input id="whatsapp" name="whatsapp" type="text" class="form-control" placeholder="ادخل رقم الواتساب">
                                        <div class="invalid-feedback">
                                            الرجاء املئ الحقل
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 my-1">
                                        <div class="form-group">
                                            <label for="">وصف الشركة</label>
                                            <textarea class="form-control" name="evaluation" id="evaluation" cols="20" rows="5"></textarea>
                                            <div class="invalid-tooltip">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">عدد المنتجات</label>
                                            <input name="products" min="0" class="form-control" type="number"  id="products">
                                            <div class="invalid-tooltip">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">خط العرض</label>
                                            <input name="latitude" min="0" class="form-control" type="text" id="latitude">
                                            <div class="invalid-tooltip">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-1">
                                        <div class="form-group">
                                            <label for="">عدد الخدمات</label>
                                            <input name="services" min="0" class="form-control" type="number"  id="services">
                                            <div class="invalid-tooltip">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="">خط الطول</label>
                                            <input name="longitude" min="0" class="form-control" type="text" id="longitude">
                                            <div class="invalid-tooltip">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="notification">أرسال أشعار</label>
                                                <input class="form-check-input" name="notification" type="checkbox" id="notification" checked="">
                                            </div>
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
            $('select[name="department_id"]').on('change', function (e) {
                var catId = e.target.value;
                if (catId) {
                    $.ajax({
                        url: '/subDepartment/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subDepartment_id"]').empty();
                            $('select[name="subDepartment_id"]').append('<option value="0">اختر فرع</option>');
                            $.each(data,function(index,subDep){
                                $('select[name="subDepartment_id"]').append('<option value ="'+subDep.id+'">'+subDep.name+'</option>');
                            });
                        }
                    })
                }
            });

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
            $('select[name="City"]').on('change', function (e) {
                var catId = e.target.value;
                if (catId) {
                    $.ajax({
                        url: '/coDepsSuper/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Department"]').empty();
                            $('select[name="Department"]').append('<option disabled selected value="0">اختر القسم</option>');
                            $.each(data,function(index,city){
                                $('select[name="Department"]').append('<option value ="'+city.id+'">'+city.name+'</option>');
                            });
                        }
                    })
                }
            });
            $('select[name="Department"]').on('change', function (e) {
                var catId = e.target.value;
                if (catId) {
                    $('select[name="subDepartment"]').show();
                    $.ajax({
                        url: '/subDepartment/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subDepartment"]').empty();
                            $('select[name="subDepartment"]').append('<option value="0">اختر فرع</option>');
                            $.each(data,function(index,subDep){
                                $('select[name="subDepartment"]').append('<option value ="'+subDep.id+'">'+subDep.name+'</option>');
                            });
                        }
                    })
                }
            });

            $('select[name="filterCountry"]').on('change', function (e) {
                var catId = e.target.value;
                if (catId) {
                    $.ajax({
                        url: '/coCitiesSuper/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="filterCity"]').empty();
                            $('select[name="filterCity"]').append('<option disabled selected>اختر المدينة</option>');
                            $.each(data,function(index,city){
                                $('select[name="filterCity"]').append('<option value ="'+city.id+'">'+city.name+'</option>');
                            });
                        }
                    })
                }
            });
            $('select[name="filterCity"]').on('change', function (e) {
                var catId = e.target.value;
                if (catId) {
                    $.ajax({
                        url: '/coDepsSuper/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="filterDep"]').empty();
                            $('select[name="filterDep"]').append('<option disabled selected>اختر القسم</option>');
                            $.each(data,function(index,city){
                                $('select[name="filterDep"]').append('<option value ="'+city.id+'">'+city.name+'</option>');
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
                    url : '{{route('Company.store')}}',
                    data: formData,
                    contentType:false,
                    processData:false,
                    success : function () {
                        Swal.fire(
                            'تم الانشاء',
                            'تم انشاء شركة بنجاح',
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
                        if (response.responseJSON.errors.address) {
                            for(let i = 0; i<response.responseJSON.errors.address.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.address[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.phone) {
                            for(let i = 0; i<response.responseJSON.errors.phone.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.phone[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.email) {
                            for(let i = 0; i<response.responseJSON.errors.email.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.email[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.image) {
                            for(let i = 0; i<response.responseJSON.errors.image.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.image[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.facebook) {
                            for(let i = 0; i<response.responseJSON.errors.facebook.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.facebook[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.instagram) {
                            for(let i = 0; i<response.responseJSON.errors.instagram.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.instagram[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.telegram) {
                            for(let i = 0; i<response.responseJSON.errors.telegram.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.telegram[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.whatsapp) {
                            for(let i = 0; i<response.responseJSON.errors.whatsapp.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.whatsapp[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.department_id) {
                            for(let i = 0; i<response.responseJSON.errors.department_id.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.department_id[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.evaluation) {
                            for(let i = 0; i<response.responseJSON.errors.evaluation.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.evaluation[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.products) {
                            for(let i = 0; i<response.responseJSON.errors.products.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.products[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.services) {
                            for(let i = 0; i<response.responseJSON.errors.services.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.services[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.longitude) {
                            for(let i = 0; i<response.responseJSON.errors.longitude.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.longitude[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.latitude) {
                            for(let i = 0; i<response.responseJSON.errors.latitude.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.latitude[i]}</li>`
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
                text: "هل تريد اعاده تفعيل هذه الشركة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/ActiveCompany/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم اعاده التفعيل!',
                                'تم اعاده تفعيل الشركة بنجاح.',
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
                text: "هل تريد الغاء تفعيل هذه الشركة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DisActiveCompany/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الغاء التفعيل!',
                                'تم الغاء تفعيل الشركة بنجاح.',
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
        function DeleteCompany(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-success text-white mx-2',
                    cancelButton: 'btn bg-danger text-white mx-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: 'هل أنت متاكد؟',
                text: "هل تريد حذف هذه الشركة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'تأكيد',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    $.ajax({
                        type: 'post',
                        url : `/DeleteCompany/${id}`,
                        success : function () {
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف الشركة بنجاح.',
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

        function NewSection(id) {
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url : `/NewSection-Company/${id}`,
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

        function MostViewedSection(id) {
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url : `/MostViewedSection-Company/${id}`,
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
        function MainSection(id) {
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url : `/MainSection-Company/${id}`,
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
