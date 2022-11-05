<x-app-dash-layout>
    <div class="container-fluid">
        <form action="" id="UpdateForm" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">تغيير عنوان الخبر</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input name="title" required id="title" class="form-control" value="{{$new->title}}">
                                <div class="invalid-tooltip">
                                    الرجاء املئ الحقل
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 my-1">
                        <button type="button" id="submitUpdateTwo" onclick="SubmitUpdate({{$new->id}})" class="btn btn-primary btn-round">تعديل</button>
                        <a href="{{route('WhatsNew')}}" class="btn btn-secondary btn-round">ألغاء</a>
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
        function SubmitUpdate(id) {
            let formData = new FormData($('#UpdateForm')[0]);
            Swal.showLoading();
            $.ajax({
                type: 'post',
                url: `/Edit-WhatsNew/${id}`,
                data: formData,
                contentType:false,
                processData:false,
                success : function () {
                    Swal.fire(
                        'تم',
                        'تم التعديل بنجاح',
                        'success'
                    ).then((result)=>{
                        window.location.replace('{{route('WhatsNew')}}')
                    });
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
    </script>
</x-app-dash-layout>
