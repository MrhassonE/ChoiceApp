<x-app-dash-layout>
    <div class="container-fluid">
        <form action="" method="post" class="needs-validation" novalidate id="UpdateForm">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">مهمتنا</h4>
                    </div>
                    <div class="card-body">
                            <div class="mb-3">
                                <textarea name="EditMissionAr" required id="EditMissionAr" class="form-control" cols="30" rows="5" autofocus>{{$about->mission_ar}}</textarea>
                                <div class="invalid-tooltip">
                                    الرجاء املئ الحقل
                                </div>
                            </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <div class="col-md-6" dir="ltr">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Our Mission</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                 <textarea name="EditMission" required id="EditMission" class="form-control" cols="30" rows="5" autofocus>{{$about->mission}}</textarea>
                                <div class="invalid-tooltip">
                                    الرجاء املئ الحقل
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <div class="col-md-12 my-1">
                <ul id="errors">

                </ul>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-round">حفظ</button>
                <a href="{{url()->previous()}}" class="btn btn-secondary btn-round">ألغاء</a>
            </div>
        </div>
        </form>
    </div>
    <script >
        let validateForm = true;
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation')
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
                $("#UpdateForm").on('submit',function (event) {
                    event.preventDefault();
                    if (validateForm === true) {
                        Swal.showLoading();
                        $.ajax({
                            type: 'post',
                            url : `/about-EditMission/{{$about->id}}`,
                            data : $("#UpdateForm").serialize(),
                            success : function (response) {
                                Swal.fire(
                                    'تم',
                                    'تم التعديل بنجاح',
                                    'success'
                                ).then((result)=>{
                                    if(result.isConfirmed) {
                                        window.location.replace('{{route('About')}}')
                                    }
                                });
                            },
                            error: function (response) {
                                if (response.responseJSON.errors.EditMission) {
                                    for(let i = 0; i<response.responseJSON.errors.EditMission.length;i++){
                                        document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.EditMission[i]}</li>`
                                    }
                                }
                                if (response.responseJSON.errors.EditMissionAr) {
                                    for(let i = 0; i<response.responseJSON.errors.EditMissionAr.length;i++){
                                        document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.EditMissionAr[i]}</li>`
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
