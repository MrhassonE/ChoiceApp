<x-app-dash-layout>
    <div class="container-fluid">
        <form method="post" class="needs-validation" novalidate id="UpdateForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">تغيير معلومات الفرع</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="">اسم الفرع</label>
                                <input id="name" value="{{$subDepartment->name}}" maxlength="100" required name="name" type="text" class="form-control" placeholder="ادخل الاسم">
                                <div class="invalid-feedback">
                                    الرجاء املئ الحقل
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <div class="col-md-12 my-1">
                    <ul id="errors"></ul>
                </div>
                <div class="col-md-12 my-1">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('sub-department-update'))
                    <button type="submit" class="btn btn-primary btn-round">تعديل</button>
                    @endif
                    <a href="{{route('Department.show',$subDepartment->Department->id)}}" class="btn btn-secondary btn-round">ألغاء</a>
                </div>
            </div>
        </form>
    </div>
    <script >
        let validateForm = true;
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
        $(`#UpdateForm`).on('submit',function (event) {
            event.preventDefault();
            if (validateForm !== false) {
                let formData = new FormData($('#UpdateForm')[0]);
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url: `{{route('SubDepartment.update',$subDepartment->id)}}`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function () {
                        Swal.fire(
                            'تم',
                            'تم التعديل بنجاح',
                            'success'
                        ).then((result) => {
                            window.location.replace('{{route('Department.show',$subDepartment->Department->id)}}')
                        });
                    },
                    error: function (response) {
                        document.getElementById('errors').innerHTML = '';
                        if (response.responseJSON.errors.name) {
                            for(let i = 0; i<response.responseJSON.errors.name.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.name[i]}</li>`
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
        })
    </script>
</x-app-dash-layout>
