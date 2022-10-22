<div class="vertical-menu">
    <style>
        .nav-link[data-bs-toggle=collapse]:after {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free";
            font-weight: 700;
            content: "\f107";
            margin-right: auto;
            color: rgba(33, 37, 41, 0.5);
            transition: all 0.2s ease-in-out;
        }
    </style>

{{--    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">--}}
{{--        <i class="bx bx-menu align-middle"></i>--}}
{{--    </button>--}}

    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @if(\Illuminate\Support\Facades\Auth::user())
                    <li class="menu-title" data-key="t-menu">لوحة التحكم</li>
                    <li class="@if(request()->routeIs('dashboard')) mm-active @endif">
                        <a class="active" href="{{route('dashboard')}}">
                            <i class="bx bx-home-alt icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">لوحة التحكم</span>
                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('about-update'))
                    <li class="@if(request()->routeIs('About*')) mm-active @endif">
                        <a href="{{route('About')}}">
                            <i class="bx bx-book-open icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">عن الشركة</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-requests-read|workshop-requests-read'))
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#client" class="nav-link @if(request()->routeIs('RequestDate.*'))active @endif" aria-controls="dashboardsExamples" role="button" aria-expanded="@if(request()->routeIs('RequestDate.*'))true @else false @endif">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-shopping-cart icon nav-icon"></i>
                            </div>
                            <span class="nav-link-text ms-1">الطلبات</span>
                            <?php
                            $new = \App\Models\RequestDate::where('status_id',1)->count()
                            ?>
                            @if($new >0)
                                <span class="badge rounded-pill bg-primary">{{$new}}</span>
                            @endif
                        </a>
                        <div class="collapse @if(request()->routeIs('RequestDate*')) show @endif" id="client">
                            <ul class="nav ms-4">
                                <li class="nav-item @if(request()->routeIs('RequestDate.newRequests')) mm-active @endif">
                                    <a class="nav-link" href="{{route('RequestDate.newRequests')}}">
                                        <i class="fa fa-shopping-cart icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-dashboard">الطلبات الجديدة</span>
                                        <?php
                                        $new = \App\Models\RequestDate::where('status_id',1)->count()
                                        ?>
                                        @if($new >0)
                                            <span class="badge rounded-pill bg-primary">{{$new}}</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item @if(request()->routeIs('RequestDate.acceptedRequests')) mm-active @endif">
                                    <a class="nav-link" href="{{route('RequestDate.acceptedRequests')}}">
                                        <i class="fa fa-shopping-cart icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-dashboard">طلبات الفحص </span>
                                    </a>
                                </li>
                                <li class="nav-item @if(request()->routeIs('RequestDate.secondStageRequests')) mm-active @endif">
                                    <a class="nav-link" href="{{route('RequestDate.secondStageRequests')}}">
                                        <i class="fa fa-shopping-cart icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-dashboard">طلبات شد المنظومة </span>
                                    </a>
                                </li>
                                <li class="nav-item @if(request()->routeIs('RequestDate.cancelledRequests')) mm-active @endif">
                                    <a class="nav-link" href="{{route('RequestDate.cancelledRequests')}}">
                                        <i class="fa fa-shopping-cart icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-dashboard">الطلبات تم الغائها</span>
                                    </a>
                                </li>
                                <li class="nav-item @if(request()->routeIs('RequestDate.lastApprovedRequests')) mm-active @endif">
                                    <a class="nav-link" href="{{route('RequestDate.lastApprovedRequests')}}">
                                        <i class="fa fa-shopping-cart icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-dashboard">تمت جميعها بنجاح</span>
                                    </a>
                                </li>
                                <li class="nav-item @if(request()->routeIs('RequestDate.archivedRequests')) mm-active @endif">
                                    <a class="nav-link" href="{{route('RequestDate.archivedRequests')}}">
                                        <i class="fa fa-shopping-cart icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-dashboard">الطلبات المؤرشفة</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('scan-qrcode-read'))
                    <li class="@if(request()->routeIs('scanQr*')) mm-active @endif">
                        <a href="{{route('scanQr')}}">
                            <i class="fa fa-qrcode icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">فحص رمز QR Code</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('city-read'))
                    <li class="@if(request()->routeIs('City*')) mm-active @endif">
                        <a href="{{route('City')}}">
                            <i class="fa fa-city icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">المدن</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('car-read'))
                    <li class="@if(request()->routeIs('Car*')) mm-active @endif">
                        <a href="{{route('Car')}}">
                            <i class="fa fa-car-side icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">انواع السيارات</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('question-read'))
                    <li class="@if(request()->routeIs('Question*')) mm-active @endif">
                        <a href="{{route('Question')}}">
                            <i class="fa fa-question-circle icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الأسئلة الشائعة</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('gas-system-read'))
                    <li class="@if(request()->routeIs('Gas*')) mm-active @endif">
                        <a href="{{route('Gas')}}">
                            <i class="fa fa-gas-pump icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">أنواع المنظومات</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('department-read'))
                    <li class="@if(request()->routeIs('Department*')) mm-active @endif">
                        <a href="{{route('Department')}}">
                            <i class="fa fa-solid fa-bars icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الأقسام</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('administrator'))
                        <li class="@if(request()->routeIs('Contact*')) mm-active @endif">
                            <a href="{{route('Contact')}}">
                                <i class="fa fa-solid fa-comments icon nav-icon"></i>
                                <span class="menu-item" data-key="t-dashboard">الأسئلة والاستفسارات</span>
                                <?php
                                $new = \App\Models\Conversation::whereHas('LastMessages',function ($q){
                                    return $q->where('read',0)->where('operation','f-User');
                                })->count();
                                ?>
                                @if($new >0)
                                    <span class="badge rounded-pill bg-primary">{{$new}}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('news-read'))
                    <li class="@if(request()->routeIs('News*')) mm-active @endif">
                        <a href="{{route('News')}}">
                            <i class="fa fa-newspaper icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الأخبار</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('service-read'))
                    <li class="@if(request()->routeIs('Service*')) mm-active @endif">
                        <a href="{{route('Service')}}">
                            <i class="bx bxs-briefcase-alt icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الخدمات</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-workshop-read|workshop-workshop-read'))
                    <li class="@if(request()->routeIs('Workshop*')) mm-active @endif">
                        <a href="{{route('Workshop')}}">
                            <i class="fa fa-building icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الورش</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-holiday-read|workshop-holiday-read'))
                    <li class="@if(request()->routeIs('Holiday*')) mm-active @endif">
                        <a href="{{route('Holiday')}}">
                            <i class="fa fa-calendar-check icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">العطل</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('station-read'))
                    <li class="@if(request()->routeIs('Station*')) mm-active @endif">
                        <a href="{{route('Station')}}">
                            <i class="fa fa-charging-station icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">المحطات</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('dist-port-read'))
                    <li class="@if(request()->routeIs('DistPort*')) mm-active @endif">
                        <a href="{{route('DistPort')}}">
                            <i class="fa fa-gas-pump icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">المنافذ</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('administrator'))
                    <li class="@if(request()->routeIs('Setting')) mm-active @endif">
                        <a href="{{route('Setting')}}">
                            <i class="fa fa-cogs icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الاعدادات</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('administrator'))
                    <li class="@if(request()->routeIs('Setting.activityLog')) mm-active @endif">
                        <a href="{{route('Setting.activityLog')}}">
                            <i class="fa fa-tasks icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">سجل النشاطات</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('administrator'))
                    <li class="@if(request()->routeIs('laratrust.roles.index')) mm-active @endif">
                        <a href="{{route('laratrust.roles.index')}}">
                            <i class="fa fa-users-cog icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الصلاحيات</span>
                        </a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('users-read'))
                    <li class="@if(request()->routeIs('Staff*')) mm-active @endif">
                        <a href="{{route('Staff')}}">
                            <i class="fa fa-users icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">المستخدمين</span>
                        </a>
                    </li>
                    @endif
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
