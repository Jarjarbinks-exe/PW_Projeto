<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{asset('dashboard')}}">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!-- Dark Logo icon -->
                    <img src="{{asset('dashboard_template/plugins/images/logo-icon.png')}}" alt="homepage" class="img-fluid" style="max-width: 30px; height: auto;" />
                </b>

                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{asset('dashboard_template/plugins/images/logo-text.png')}}" alt="homepage" class="img-fluid" style="max-width: 150px; height: auto;"/>
                        </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
               href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">

                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li>
                    <a class="profile-pic" href="{{ route('profile.edit') }}">
                        <img src="{{ asset('dashboard_template/plugins/images/users/1_v2.jpg') }}" alt="user-img" width="36" class="img-circle">
                        <span class="text-white font-medium">{{ auth()->user()->username }}</span>
                    </a>
                </li>

                <li class="in">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn text-white">
                            <i class="fas fa-power-off"></i> {{ __('Log Out') }}
                        </button>
                    </form>
                </li>



                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
