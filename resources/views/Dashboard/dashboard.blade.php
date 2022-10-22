<x-app-dash-layout>
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
                                                <i class="fa fa-luggage-cart font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">طلبات الحجوزات</h6>
                                            <h4 class="d-flex font-size-20">{{$orders}}</h4>
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
                                            <h6 class="d-flex mb-0 font-size-15">الخدمات</h6>
                                            <h4 class="d-flex font-size-20">{{$services}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <h6 class="mb-0 font-size-15">عدد الورش الكلي</h6>
                                            <h4 class="d-flex font-size-20">{{$workshops}}</h4>
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
                                                <i class="fa fa-charging-station icon nav-icon font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0 font-size-15">عدد المحطات الكلي</h6>
                                            <h4 class="d-flex font-size-20">{{$stations}}</h4>
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
                                                <i class="fa fa-newspaper icon nav-icon font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">الاخبار</h6>
                                            <h4 class="d-flex font-size-20">{{$news}}</h4>
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
                                                <i class="fa fa-question-circle font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">الأسئلة الشائعة</h6>
                                            <h4 class="d-flex font-size-20">{{$questions}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-title rounded bg-soft-primary">
                                                <i class="fa fa-gas-pump icon nav-icon font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">عدد المنافذ الكلي</h6>
                                            <h4 class="d-flex font-size-20">{{$distPorts}}</h4>
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
                                                <i class="fa fa-car-side icon nav-icon font-size-24 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="d-flex mb-0 font-size-15">انواع السيارات</h6>
                                            <h4 class="d-flex font-size-20">{{$carTypes->count()}}</h4>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">أنواع الخدمات في التطبيق</h3>

                    </div>
                    <div class="card-body">
                        <div class="row mt-2 d-flex" id="grid-leader">
                            <div class="table-responsive">
                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الخدمة</th>
                                        <th>اللون</th>
                                        <th>الشعار</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($serviceTypes as $key=>$serviceType)
                                        <tr>
                                            <td class="fw-semibold">{{$key + 1}}</td>
                                            <td>
                                                {{$serviceType->title}}
                                            </td>
                                            <td>
                                                <span style="background: {{$serviceType->color}}; height: 10px; width: 20px" class="badge text-white"> </span>
                                            </td>
                                            <td>
                                                <img src="{{$serviceType->img_path}}" class="rounded-circle avatar img-thumbnail" alt="">
                                            </td>
                                            {{--                                                            <td>--}}
                                            {{--                                                                <a href="{{route('ServiceType.edit',$serviceType->id)}}" class="text-primary" ><i class="fa fa-pen me-1"></i></a>--}}
                                            {{--                                                                <a href="javascript:;" onclick="DeleteContact({{$serviceType->id}})" class="text-danger"><i class="bx bx-trash"></i></a>--}}
                                            {{--                                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">أنواع السيارات</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2 d-flex" id="grid-leader">
                            <div class="table-responsive">
                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الأسم</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carTypes as $key=>$carType)
                                        <tr>
                                            <td class="fw-semibold">{{$key + 1}}</td>
                                            <td>
                                                {{$carType->title}}
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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">العطل الجديدة</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2 d-flex" id="grid-leader">
                            <div class="table-responsive">
                                <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الأسم</th>
                                        <th>تبدء في</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($holidays as $key=>$holiday)
                                        <tr>
                                            <td class="fw-semibold">{{$key + 1}}</td>
                                            <td>
                                                {{$holiday->message}}
                                            </td>
                                            <td>
                                                {{$holiday->start}}
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

{{--    <script src="{{asset('assetsDashboard/libs/apexcharts/apexcharts.min.js')}}"></script>--}}
{{--    <script>--}}

{{--        function getChartColorsArray(e) {--}}
{{--            if (null !== document.getElementById(e)) {--}}
{{--                var r = document.getElementById(e).getAttribute("data-colors");--}}
{{--                return (r = JSON.parse(r)).map(function (e) {--}}
{{--                    var r = e.replace(" ", "");--}}
{{--                    if (-1 == r.indexOf("--")) return r;--}}
{{--                    var t = getComputedStyle(document.documentElement).getPropertyValue(r);--}}
{{--                    return t || void 0--}}
{{--                })--}}
{{--            }--}}
{{--        }--}}

{{--        options = {--}}
{{--            chart: {height: 350, type: "donut"},--}}
{{--            series: [24,53],--}}
{{--            labels: ["الاناث", "الذكور"],--}}
{{--            colors: barchartColors = getChartColorsArray("saleing-categories"),--}}
{{--            plotOptions: {--}}
{{--                pie: {--}}
{{--                    startAngle: 25,--}}
{{--                    donut: {--}}
{{--                        size: "72%",--}}
{{--                        labels: {--}}
{{--                            show: !0,--}}
{{--                            total: {--}}
{{--                                show: !0,--}}
{{--                                label: "الوظائف",--}}
{{--                                fontSize: "22px",--}}
{{--                                fontFamily: "Montserrat,sans-serif",--}}
{{--                                fontWeight: 600--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            },--}}
{{--            legend: {--}}
{{--                show: !1,--}}
{{--                position: "bottom",--}}
{{--                horizontalAlign: "center",--}}
{{--                verticalAlign: "middle",--}}
{{--                floating: !1,--}}
{{--                fontSize: "14px",--}}
{{--                offsetX: 0--}}
{{--            },--}}
{{--            dataLabels: {--}}
{{--                style: {fontSize: "11px", fontFamily: "Montserrat,sans-serif", fontWeight: "bold", colors: void 0},--}}
{{--                background: {--}}
{{--                    enabled: !0,--}}
{{--                    foreColor: "#fff",--}}
{{--                    padding: 4,--}}
{{--                    borderRadius: 2,--}}
{{--                    borderWidth: 1,--}}
{{--                    borderColor: "#fff",--}}
{{--                    opacity: 1--}}
{{--                }--}}
{{--            },--}}
{{--            responsive: [{breakpoint: 600, options: {chart: {height: 240}, legend: {show: !1}}}]--}}
{{--        };--}}
{{--        (chart = new ApexCharts(document.querySelector("#saleing-categories"), options)).render();--}}

{{--    </script>--}}
</x-app-dash-layout>
