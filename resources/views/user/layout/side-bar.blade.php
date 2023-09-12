<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">

<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header justify-content-lg-center">
            <!-- Logo -->
            <div>
              <span class="smini-visible fw-bold tracking-wide fs-lg">
                c<span class="text-primary">b</span>
              </span>
                <a class="link-fx fw-bold tracking-wide mx-auto" href="{{url('/')}}">
                <span class="smini-hidden">
                    <img src="{{asset("logo-black.png")}}"  style="width: 40px;" alt="logo">
                  <span class="fs-4 text-dual">SpeakEde</span>
                </span>
                </a>
            </div>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-danger d-lg-none" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-fw fa-times"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side User -->
            <div class="content-side content-side-user px-0 py-0">
                <!-- Visible only in mini mode -->
                <div class="smini-visible-block animated fadeIn px-3">

                    @if(!empty(Auth::user()->profile_image))
                        <div class="figure mb-3">
                            <img src="{{asset('profile/photo/'.Auth::user()->id.'/'.Auth::user()->profile_image)}}" class="img-avatar" alt="image">
                        </div>
                    @else
                        <div class="figure mb-3">
                            <img src="{{asset('avater2.png')}}" class="img-avatar" alt="image">
                        </div>
                    @endif
                </div>
                <!-- END Visible only in mini mode -->

                <!-- Visible only in normal mode -->
                <div class="smini-hidden text-center mx-auto">
                    <a class="img-link" href="{{route('user.dashboard')}}">

                        @if(!empty(Auth::user()->profile_image))
                            <div class="figure mb-3">
                                <img src="{{asset('profile/photo/'.Auth::user()->id.'/'.Auth::user()->profile_image)}}" class="img-avatar" alt="image">
                            </div>
                        @else
                            <div class="figure mb-3">
                                <img src="{{asset('avater2.png')}}" class="img-avatar" alt="image">
                            </div>
                        @endif

                    </a>
                    <ul class="list-inline mt-3 mb-0">
                        <li class="list-inline-item">
                            <a class="link-fx text-dual fs-sm fw-semibold text-uppercase" href="{{route('user.dashboard')}}">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="link-fx text-dual" href="{{route('account.logout')}}">
                                <i class="fa fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END Visible only in normal mode -->
            </div>
            <!-- END Side User -->

            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">


                    <li class="nav-main-item {{Request::segment(2)  === "course" ? "open" : ""}}">
                        <a class="nav-main-link" href="{{route('user.dashboard')}}">
                            <i class="nav-main-link-icon fa fa-dashboard"></i>
                            <span class="nav-main-link-name">DASHBOARD</span>
                        </a>
                    </li>


                    <li class="nav-main-item {{Request::segment(2)  === "discover" ? "open" : ""}}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="">
                                <i class="nav-main-link-icon fa fa-search"></i><span class="nav-main-link-name" onclick="loadUrl()"> DISCOVER</span>

                        </a>
                        <ul class="nav-main-submenu">

                            <li class="nav-main-item {{Request::segment(3) ==="theme"  ? "open" : ""}}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-user-group"></i>
                                    <span class="nav-main-link-name">Theme</span>
                                </a>
                                <ul class="nav-main-submenu">

                                    @foreach(\App\Models\Category::query()->where('class_name', 'use_cases')->get() as $row)
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{Request::segment(4) ==="tutors"  ? "active" : ""}}" href="{{route('user.dashboard.discover.theme')}}?link={{$row->url}}">
                                            <span class="nav-main-link-name">{{$row->title}}</span>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </li>

                            <li class="nav-main-item {{Request::segment(3) ==="type"  ? "open" : ""}}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon fa fa-user-group"></i>
                                    <span class="nav-main-link-name">TYPE</span>
                                </a>
                                <ul class="nav-main-submenu">

                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{Request::segment(4) ==="tutors"  ? "active" : ""}}" href="{{route('user.dashboard.discover.course.free')}}">
                                            <span class="nav-main-link-name">FREE</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{Request::segment(4) ==="course"  ? "active" : ""}}" href="{{route('user.dashboard.discover.course.paid')}}">
                                            <span class="nav-main-link-name">PAID</span>
                                        </a>
                                    </li>


                                </ul>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{Request::segment(4) ==="tutors"  ? "active" : ""}}" href="{{route('user.dashboard.discover.tutors')}}">
                                    <i class="nav-main-link-icon fa fa-user-group"></i>
                                    <span class="nav-main-link-name">TUTORS</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link{{Request::segment(4) ==="course"  ? "active" : ""}}" href="{{route('user.dashboard.discover.course')}}">
                                    <i class="nav-main-link-icon fa fa-book"></i>
                                    <span class="nav-main-link-name">COURSES</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('user.dashboard.discover.sessions')}}">
                                    <i class="nav-main-link-icon fa fa-book"></i>
                                    <span class="nav-main-link-name">ONLINE SESSIONS</span>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-calendar-times"></i>
                            <span class="nav-main-link-name">CREATE/SCHEDULE</span>
                        </a>

                        <ul class="nav-main-submenu">

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('user.dashboard.course')}}">
                                    <i class="nav-main-link-icon fa fa-book"></i>
                                    <span class="nav-main-link-name"> COURSE</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('user.group.class.create')}}">
                                    <i class="nav-main-link-icon fa fa-user-group"></i>
                                    <span class="nav-main-link-name">GROUP SESSIONS</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('user.schedule.availability')}}">
                                    <i class="nav-main-link-icon fa fa-user-alt"></i>
                                    <span class="nav-main-link-name">PRIVATE</span>
                                </a>
                            </li>

                        </ul>

                    </li>


                    <li class="nav-main-item {{Request::segment(2)  === "wallet" ? "open" : ""}}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-wallet"></i>
                            <span class="nav-main-link-name">WALLET</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{route('user.dashboard.wallet')}}">
                                    <span class="nav-main-link-name">FUND WALLET</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-main-item {{Request::segment(3)  === "photo" ? "open" : ""}}">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-user-lock"></i>
                            <span class="nav-main-link-name">SETTINGS </span>
                        </a>
                        <ul class="nav-main-submenu">

                            <li class="nav-item {{Request::segment(3)  === "photo" ? "open" : ""}}">
                                <a href="{{route('user.profile.photo')}}" class="nav-main-link {{Request::segment(3)  === "photo" ? "active" : ""}}">
                                    <span class="nav-main-link-nam">UPDATE PROFILE PHOTO</span>
                                </a>
                            </li>

                            <li class="nav-item {{Request::segment(2)  === "add-withdrawal-details" ? "open" : ""}}">
                                <a href="{{route('user.withdrawal.details')}}" class="nav-main-link {{Request::segment(2)  === "add-withdrawal-details" ? "active" : ""}}">
                                    <span class="nav-main-link-nam">UPDATE WITHDRAW DETAILS</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('user.password') }}">
                                    <span class="nav-main-link-name">CHANGE PASSWORD</span>
                                </a>
                            </li>




                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="{{route('account.logout')}}">
                            <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                            <span class="nav-main-link-name">LOGOUT</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->

<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="space-x-1">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Open Search Section -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-fw fa-search"></i>
            </button>
            <!-- END Open Search Section -->

        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="space-x-1">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block fw-semibold">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</span>
                    <i class="fa fa-angle-down opacity-50 ms-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                    <div class="px-2 py-3 bg-body-light rounded-top">
                        <h5 class="h6 text-center mb-0">
                            {{Auth::user()->firstname.' '.Auth::user()->lastname}}
                        </h5>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="{{route('account.logout')}}">
                            <span>Sign Out</span>
                            <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->

        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group">
                    <!-- Close Search Section -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                    <!-- END Close Search Section -->
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    <button type="submit" class="btn btn-secondary">
                        <i class="fa fa-fw fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="far fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->
