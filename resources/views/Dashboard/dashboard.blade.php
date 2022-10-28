<x-appDash-layout>
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xl-6">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <div class="avatar-title rounded bg-soft-primary">--}}
{{--                                                <i class="fa fa-newspaper icon nav-icon font-size-24 mb-0 text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="flex-grow-1 ms-3">--}}
{{--                                            <h6 class="d-flex mb-0 font-size-15">الأخبار</h6>--}}
{{--                                            <h4 class="d-flex font-size-20">{{$news}}</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-xl-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <div class="avatar-title rounded bg-soft-primary">--}}
{{--                                                <i class="bx bx bx bxs-briefcase-alt font-size-24 mb-0 text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-grow-1 ms-3">--}}
{{--                                            <h6 class="d-flex mb-0 font-size-15">الخدمات</h6>--}}
{{--                                            <h4 class="d-flex font-size-20">{{$services}}</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <div class="avatar-title rounded bg-soft-primary">--}}
{{--                                                <i class="bx bx-package font-size-24 mb-0 text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-grow-1 ms-3">--}}
{{--                                            <h6 class="mb-0 font-size-15">عدد الزيارات الكلي</h6>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h4 class="mt-4 pt-1 mb-0 font-size-22">{{showAmount($visitors->visit_all)}}</h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <div class="avatar-title rounded bg-soft-primary">--}}
{{--                                                <i class="bx bx-package font-size-24 mb-0 text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-grow-1 ms-3">--}}
{{--                                            <h6 class="mb-0 font-size-15">عدد الزيارات لهذا الشهر</h6>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h4 class="mt-4 pt-1 mb-0 font-size-22">{{showAmount($visitors->visit_monthly)}}</h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-xl-6">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <div class="avatar-title rounded bg-soft-primary">--}}
{{--                                                <i class="fa fa-calendar-alt font-size-24 text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-grow-1 ms-3">--}}
{{--                                            <h6 class="d-flex mb-0 font-size-15">الندوات</h6>--}}
{{--                                            <h4 class="d-flex font-size-20">{{$seminars}}</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <div class="avatar-title rounded bg-soft-primary">--}}
{{--                                                <i class="fa fa-lightbulb font-size-24 mb-0 text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-grow-1 ms-3">--}}
{{--                                            <h6 class="d-flex mb-0 font-size-15">الأنجازات </h6>--}}
{{--                                            <h4 class="d-flex font-size-20">{{showAmount($achievements)}}</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="avatar">--}}
{{--                                            <div class="avatar-title rounded bg-soft-primary">--}}
{{--                                                <i class="bx bx-package font-size-24 mb-0 text-primary"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex-grow-1 ms-3">--}}
{{--                                            <h6 class="mb-0 font-size-15">عدد الزيارات لهذا اليوم</h6>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <h4 class="mt-4 pt-1 mb-0 font-size-22">{{showAmount($visitors->visit_daily)}}</h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <a href="#" data-bs-toggle="modal" data-bs-target=".support"
       style="background:#213A75;padding: 20px;font-size: 20px;position: fixed; opacity: 0.8; bottom: 30px;left: 20px;color: #fff;border-radius: 50%;z-index: 10000;"
       class="d-flex justify-content-center">
        <i class="fa fa-headset" aria-hidden="true"></i>
    </a>

    <div class="modal fade support" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">للتواصل مع فريق الدعم الفني</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 my-1">
                            <div class="form-group text-md-center">
                                <h4 class="text-dark"> 07838255584 <i class="fa fa-phone-alt"></i></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 my-1">

                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</x-appDash-layout>
