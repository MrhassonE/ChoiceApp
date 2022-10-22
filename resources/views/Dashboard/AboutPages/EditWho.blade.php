<x-app-dash-layout>
    <div class="container-fluid">
        <form action="" id="UpdateForm" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">من نحن</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <textarea name="EditWhoAr" maxlength="500" required id="EditWhoAr" class="form-control" cols="100" rows="5" autofocus>{{$about->title}}</textarea>
                                <div class="invalid-tooltip">
                                    الرجاء املئ الحقل
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <ul id="errors">
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <button type="submit" class="btn btn-primary w-100">حفظ</button>
                    </div>
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
                    url : `/aboutWhoWeAre/{{$about->id}}`,
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
                        console.log(response);
                        if(response.responseJSON.errors.EditWhoAr){
                            document.getElementById('errors').innerHTML += `<li class="text-danger">${response.responseJSON.errors.EditWhoAr}</li>`
                        }
                        swal.hideLoading();
                        Swal.fire(
                            'لم يتم اكمال العملية',
                            `هناك خطأ في المدخلات`,
                            'warning'
                        )
                    }
                })
            }
        })
    </script>
</x-app-dash-layout>
