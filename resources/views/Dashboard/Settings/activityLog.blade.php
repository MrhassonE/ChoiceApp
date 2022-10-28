<x-appDash-layout>
    <div class="container-fluid">
        <!-- end row -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">سجل النشاطات<span class="text-muted fw-normal ms-2"> ({{$activities->count()}})</span></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-filter me-1"></i>فرز حسب</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="modal fade add-new" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myExtraLargeModalLabel">فرز حسب</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('Setting.activityLog')}}" method="get" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-12 my-1">
                                                    <div class="form-group">
                                                        <label class="mt-0">المستخدم</label>
                                                        <select class="form-control" name="user" id="userFilter">
                                                            <option value="">اختر المستخدم</option>
                                                            @foreach($users  as $user)
                                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row my-3 ">
                                                        <label for="">فرز حسب تاريخ الزيارة</label>
                                                        <div class="col-md-4 my-1">
                                                            <div class="form-group">
                                                                <label for="">التاريخ من</label>
                                                                <input id="start" required name="start" type="text" class="form-control" placeholder="ادخل التاريخ من">
                                                                <div class="invalid-feedback">
                                                                    الرجاء املئ الحقل
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 my-1">
                                                            <div class="form-group">
                                                                <label for="">التاريخ الى</label>
                                                                <input id="end" required name="end" type="text" class="form-control" placeholder="ادخل التاريخ الى">
                                                                <div class="invalid-feedback">
                                                                    الرجاء املئ الحقل
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 my-1">
                                                    <button id="submitButton" type="submit" class=" btn btn-primary btn-round">فرز</button>
                                                    <button type="reset" onclick="this.closest('form').reset();window.location.replace('{{route('Setting.activityLog')}}')" class="btn btn-primary">عرض الكل</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <div class="row mt-2 d-flex" id="grid-leader">
                            <div class="table-responsive">
                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>النشاط</th>
                                        <th>المستخدم</th>
                                        <th>الوقت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($activities as $key=>$activity)
                                        <tr>
                                            <td class="fw-semibold">{{$key + 1}}</td>
                                            <td>
                                                {{$activity->activity}}
                                            </td>
                                            <td>
                                                @if($activity->User)
                                                    {{$activity->User->name}}
                                                @else()
                                                    المستخدم محذوف
                                                @endif
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse($activity->created_at)->format('Y-m-d | H:i')}}
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
    </div>
    <script>
        flatpickr('#start', {
            onChange: function () {
                flatpickr('#end', {
                    minDate: document.getElementById('start').value
                })
            }
        });
        flatpickr('#end', {
            onChange: function () {
                flatpickr('#start', {
                    maxDate: document.getElementById('end').value
                })
            }
        });

    </script>
</x-appDash-layout>
