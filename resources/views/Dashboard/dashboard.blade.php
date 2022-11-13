<x-appDash-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-xl-4">
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
                <div class="col-xl-4">
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
                                        <h6 class="d-flex mb-0 font-size-15">أقسام الواجهة الرئيسية</h6>
                                        <h4 class="d-flex font-size-20">{{$departmentsMain}}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
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
            <div class="row">
                <div class="col-xl-4">
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
                                        <h6 class="d-flex mb-0 font-size-15">الشركات الجديدة</h6>
                                        <h4 class="d-flex font-size-20">{{$companiesNew}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
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
                                        <h6 class="d-flex mb-0 font-size-15">شركات الاكثر مشاهدة</h6>
                                        <h4 class="d-flex font-size-20">{{$companiesMostViewed}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
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
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="fa fa-eye font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="d-flex mb-0 font-size-15">الزيارات لهذا اليوم</h6>
                                        <h4 class="d-flex font-size-20">{{$idvisit}}</h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="fa fa-eye font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="d-flex mb-0 font-size-15">الزيارات لهذا الشهر</h6>
                                        <h4 class="d-flex font-size-20">{{$imvisit}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-title rounded bg-soft-primary">
                                            <i class="fa fa-eye font-size-24 mb-0 text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="d-flex mb-0 font-size-15">عدد الزيارات الكلي</h6>
                                        <h4 class="d-flex font-size-20">{{$iavisit}}</h4>
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
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-2">أحصائيات الزيارات</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line1" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        var ctx1 = document.getElementById("chart-line1").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

        // Line chart
        let dataProjectChart1 = [];
        let dataProjectChart2 = [];
        @foreach($avisitEveryMonth as $project)
        dataProjectChart1.push({{$project}});
        @endforeach
        @foreach($ivisitEveryMonth as $project)
        dataProjectChart2.push({{$project}});
        @endforeach
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Jun","Feb","Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [
                    {
                        label: "عدد زيارات الأندرويد",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 2,
                        pointBackgroundColor: "#8392ab",
                        borderColor: "#8392ab",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        data: dataProjectChart1,
                        maxBarThickness: 6
                    },
                    {
                        label: "عدد زيارات الأيفون",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 2,
                        pointBackgroundColor: "#2dce89",
                        borderColor: "#2dce89",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        data: dataProjectChart2,
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7'
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10
                        }
                    },
                },
            },
        });

    </script>
</x-appDash-layout>
