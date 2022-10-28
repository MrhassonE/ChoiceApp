<x-app-dash-layout>
    <div class="container-fluid">
        <form action="" method="post" id="UpdateForm" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">اهدافنا</h4>
                    </div>
                    <div class="card-body">
                            <div class="mb-3">
                                <textarea name="EditGoalAr" required id="EditGoalAr" class="form-control" cols="30" rows="5" autofocus>{{$about->goal_ar}}</textarea>
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
                        <h4 class="card-title mb-0">Our Goals</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <textarea name="EditGoal" required id="EditGoal" class="form-control" cols="30" rows="5" autofocus>{{$about->goal}}</textarea>
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
        $("#UpdateForm").on('submit',function (event) {
            event.preventDefault();
            if (validateForm === true) {
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : `/about-EditGoal/{{$about->id}}`,
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
                        if (response.responseJSON.errors.EditGoal) {
                            for(let i = 0; i<response.responseJSON.errors.EditGoal.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.EditGoal[i]}</li>`
                            }
                        }
                        if (response.responseJSON.errors.EditGoalAr) {
                            for(let i = 0; i<response.responseJSON.errors.EditGoalAr.length;i++){
                                document.getElementById('errors').innerHTML += `<li class="text-danger" >${response.responseJSON.errors.EditGoalAr[i]}</li>`
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
