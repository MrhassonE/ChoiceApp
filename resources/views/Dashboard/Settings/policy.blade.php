<x-appDash-layout>
    <div class="container-fluid">
        <div class="row">
            <form action="" id="UpdateForm" class="needs-validation" novalidate>
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">السياسة والشروط</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">السياسة والخصوصية</label>
                                            <textarea name="policy" required maxlength="500" id="" class="form-control" cols="30" rows="10">{{$setting_info->policy}}</textarea>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">شروط الخدمات</label>
                                            <textarea name="conditions"  maxlength="500" id="" class="form-control" cols="30" rows="10">{{$setting_info->conditions}}</textarea>
                                            <div class="invalid-feedback">
                                                الرجاء املئ الحقل
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <ul id="errors3"></ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 my-1">
                                            <button type="submit" id="submitUpdateTwo" onclick="SubmitUpdate({{$setting_info->id}})" class="btn btn-primary btn-round">تعديل</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <script>
        let validateFormPolicy = false;
        (function () {
            'use strict';
            const forms = document.querySelectorAll('#infoForm');
            Array.from(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                            validateFormPolicy = false;
                        }
                        else {
                            validateFormPolicy = true;

                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })();
        function SubmitUpdate(id) {
            event.preventDefault();
            let formData = new FormData($('#UpdateForm')[0]);
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url: `/setting/policyConditions/${id}`,
                data: formData,

                contentType:false,
                processData:false,
                success : function () {
                    Swal.fire(
                        'تم',
                        'تم تعديل السياسة والشروط بنجاح',
                        'success'
                    ).then((result)=>{
                        window.location.replace('{{route('Setting.policy')}}')
                    });
                },
                error: function (response) {
                    document.getElementById('errors3').innerHTML = '';
                    if(response.responseJSON.errors.policy) {
                        document.getElementById('errors3').innerHTML += `<li>${response.responseJSON.errors.policy}</li>`
                    }
                    if(response.responseJSON.errors.conditions) {
                        document.getElementById('errors3').innerHTML += `<li>${response.responseJSON.errors.conditions}</li>`
                    }
                    Swal.fire(
                        'لم يتم اكمال العملية',
                        `هناك خطأ في المدخلات`,
                        'warning'
                    )
                }
            })
        }
    </script>
</x-appDash-layout>
