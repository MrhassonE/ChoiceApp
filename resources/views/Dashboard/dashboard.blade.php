<x-appDash-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="fa fa-building icon nav-icon font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">عدد الاقسام الكلي</h6>
                                            <h4 class="d-flex font-size-20">{{$departments}}</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="bx bx bx bxs-briefcase-alt font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">عدد الشركات الكلي</h6>
                                            <h4 class="d-flex font-size-20">{{$companies}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="fa fa-ad font-size-24 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">الاعلانات</h6>
                                            <h4 class="d-flex font-size-20">{{$ads}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
