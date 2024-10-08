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
            transition: all 0.1s ease-in-out;
        }
    </style>


    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">لوحة التحكم</li>

                <li class="@if(request()->routeIs('Dashboard')) mm-active @endif">
                    <a class="active" href="{{route('Dashboard')}}">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">لوحة التحكم</span>
                    </a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-department-read|country-department-read'))
                    <li class="@if(request()->routeIs('Department*')) mm-active @endif">
                        <a href="{{route('Department')}}">
                            <i class="fa fa-building icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الاقسام</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-company-read|country-company-read'))
                    <li class="@if(request()->routeIs('Company*')) mm-active @endif">
                        <a href="{{route('Company')}}">
                            <i class="bx bxs-briefcase icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الشركات</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-advertisement-read|country-advertisement-read'))
                    <li class="@if(request()->routeIs('Advertisement*')) mm-active @endif">
                        <a href="{{route('Advertisement')}}">
                            <i class="fa fa-ad icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الأعلانات</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('notification-read'))
                    <li class="@if(request()->routeIs('CustomNotification*')) mm-active @endif">
                        <a href="{{route('CustomNotification')}}">
                            <i class="fa fa-solid fa-bell"></i>
                            <span class="menu-item" data-key="t-dashboard">الأشعارات</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-blog-read|company-blog-read'))
                    <li class="@if(request()->routeIs('Blog*')) mm-active @endif">
                        <a href="{{route('Blog')}}">
                            <i class="fa fa-newspaper icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">المقالات</span>
                        </a>
                    </li>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('whats-new-read'))
                    <li class="@if(request()->routeIs('WhatsNew*')) mm-active @endif">
                        <a href="{{route('WhatsNew')}}">
                            <i class="fa fa-newspaper icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">ما الجديد</span>
                        </a>
                    </li>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-city-read|country-city-read'))
                    <li class="@if(request()->routeIs('City*')) mm-active @endif">
                        <a href="{{route('City')}}">
                            <i class="fa fa-city icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">المدن</span>
                        </a>
                    </li>
                @endif

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('superAdministrator'))
                    <li class="@if(request()->routeIs('Country*')) mm-active @endif">
                        <a href="{{route('Country')}}">
                            <i class="fa fa-city icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الدول</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasPermission('all-users-read|country-users-read'))
                    <li class="@if(request()->routeIs('Staff*')) mm-active @endif">
                        <a href="{{route('Staff')}}">
                            <i class="fa fa-users icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">المستخدمين</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('superAdministrator|administrator'))
                    <li class="@if(request()->routeIs('Setting.ActivityLog')) mm-active @endif">
                        <a class="active" href="{{route('Setting.activityLog')}}">
                            <i class="fa fa-tasks icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">سجل النشاطات</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('superAdministrator'))
                    <li class="@if(request()->routeIs('Setting')) mm-active @endif">
                        <a href="{{route('Setting')}}">
                            <i class="fa fa-cogs icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">الاعدادات</span>
                        </a>
                    </li>
                    <li class="@if(request()->routeIs('Setting.policy')) mm-active @endif">
                        <a href="{{route('Setting.policy')}}">
                            <i class="fa fa-user-shield icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboard">السياسة والشروط</span>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('superAdministrator|administrator'))
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#laratrust" class="nav-link @if(request()->routeIs('laratrust.*'))active @endif" aria-controls="dashboardsExamples" role="button" aria-expanded="@if(request()->routeIs('laratrust.*'))true @else false @endif">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-users-cog icon nav-icon"></i>
                            </div>
                            <span class="nav-link-text ms-1">الصلاحيات</span>
                        </a>
                        <ul id="laratrust" class="nav ms-4 collapse @if(request()->routeIs('laratrust.*')) show @endif">
                            <li class="@if(request()->routeIs('laratrust.roles.index')) mm-active @endif">
                                <a class="nav-link" href="{{route('laratrust.roles.index')}}">
                                    <i class="fa fa-users-cog icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-dashboard">الأدوار</span>
                                </a>
                            </li>
                            <li class="@if(request()->routeIs('laratrust.roles-assignment.index')) mm-active @endif">
                                <a class="active" href="{{route('laratrust.roles-assignment.index')}}">
                                    <i class="fa fa-users-cog icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-dashboard">تعيين الأدوار والأذونات</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="mt-0 mt-md-10 row" dir="ltr">
        <h6 class=" text-md-center mb-3 text-dark">
            © Developed by Maxware.
        </h6>
    </div>
</div>
