<header id="page-topbar" class="isvertical-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
                <i class="bx bx-menu align-middle"></i>
            </button>
            <!-- start page title -->
            <div class="page-title-box align-self-center d-none d-md-block">
                <h4 class="page-title mb-0">{{__('route.'.request()->route()->getName().'')}}</h4>
            </div>
            <!-- end page title -->
        </div>
        <div class="d-flex">
            @auth()
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown-v"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-xl-inline-block ms-2 fw-medium font-size-18">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="top: 0 !important;">

                        <a class="dropdown-item" href="{{ route('Profile') }}">
                            <i class="mdi mdi-face-profile text-muted font-size-16 align-middle me-2"></i>{{ __('عرض الملف الشخصي') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-muted font-size-16 align-middle me-2"></i>{{ __('تسجيل خروج') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>
            @endauth
        </div>
    </div>
</header>
<script>
    function logout() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-success text-white mx-2',
                cancelButton: 'btn bg-danger text-white mx-2'
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: 'هل نت متاكد؟',
            text: "هل تريد تسجيل الخروج!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'تسجيل خروج',
            cancelButtonText: 'الغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.showLoading();
                $.ajax({
                    type: 'post',
                    url : '{{route('logout')}}',
                    success : function () {
                        window.location.replace('{{route('dashboard')}}');
                    }
                })
            }
        })
    }
</script>
