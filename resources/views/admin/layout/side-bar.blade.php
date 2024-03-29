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
                    <a class="img-link" href="{{route('admin.dashboard')}}">


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
                            <a class="link-fx text-dual fs-sm fw-semibold text-uppercase" href="">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</a>
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
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="{{route('admin.dashboard')}}">
                            <i class="nav-main-link-icon fa fa-house-user"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">User Interface</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('admin.user.index')}}">
                            <i class="nav-main-link-icon fa fa-user-group"></i>
                            <span class="nav-main-link-name">USERS</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('admin.user.tutors')}}">
                            <i class="nav-main-link-icon fa fa-user-group"></i>
                            <span class="nav-main-link-name">TUTORS</span>
                        </a>
                    </li>


                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('admin.course.all')}}">
                            <i class="nav-main-link-icon fa fa-user-group"></i>
                            <span class="nav-main-link-name">COURSES</span>
                        </a>
                    </li>


                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('admin.group.all')}}">
                            <i class="nav-main-link-icon fa fa-user-group"></i>
                            <span class="nav-main-link-name">GROUP SESSIONS</span>
                        </a>
                    </li>


                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('admin.private.sessions.all')}}">
                            <i class="nav-main-link-icon fa fa-user-group"></i>
                            <span class="nav-main-link-name">PRIVATE SESSIONS</span>
                        </a>
                    </li>


                    <li class="nav-main-item">
                        <a class="nav-main-link "href="{{route('admin.transactions.funding')}}">
                            <i class="nav-main-link-icon fa fa-wallet"></i>  <span class="nav-main-link-name">WALLET TRANSACTION</span>
                        </a>
                    </li>


                    <li class="nav-main-heading">OTHERS</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-vector-square"></i>
                            <span class="nav-main-link-name">LANGUAGE</span>
                        </a>
                        <ul class="nav-main-submenu">

                            @foreach(\App\Http\Controllers\Admin\AdminController::getAccessControl(auth()->user()->id) as $row)

                                @if($row->title === "Create")
                                    <li class="nav-main-item">
                                        <a class="nav-main-link " aria-haspopup="true" aria-expanded="false" href="{{route('admin.add.cat')}}">
                                            <span class="nav-main-link-name">ADD GLOBAL LANGUAGE</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link " aria-haspopup="true" aria-expanded="false" href="{{route('admin.add.tutor')}}">
                                            <span class="nav-main-link-name">ADD TUTOR LANGUAGE</span>
                                        </a>
                                    </li>
                                @endif
                               @endforeach

                            <li class="nav-main-item">
                                <a class="nav-main-link " aria-haspopup="true" aria-expanded="false" href="{{route('admin.view.cat')}}">
                                    <span class="nav-main-link-name">ALL LANGUAGE</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-main-item">
                        <a class="nav-main-link " aria-haspopup="true" aria-expanded="false" href="{{route('admin.add.use.cases')}}">
                            <i class="nav-main-link-icon fa fa-vector-square"></i> <span class="nav-main-link-name">THEME</span>
                        </a>
                    </li>



                    <li class="nav-main-heading">ACCOUNT</li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-user-lock"></i>
                            <span class="nav-main-link-name">USERS </span>
                        </a>
                        <ul class="nav-main-submenu">

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('admin.user.all') }}">
                                    <span class="nav-main-link-name">ALL TEAM</span>
                                </a>
                            </li>


                            @foreach(\App\Http\Controllers\Admin\AdminController::getAccessControl(auth()->user()->id) as $row)

                                @if($row->title === "Create")

                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{ route('admin.user.add') }}">
                                        <span class="nav-main-link-name">ADD TEAM MEMBER</span>
                                    </a>
                                </li>
                                @endif
                            @endforeach

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('admin.user.account.add') }}">
                                    <span class="nav-main-link-name"> ADD USER ACCOUNT</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-user-lock"></i>
                            <span class="nav-main-link-name">CMS </span>
                        </a>
                        <ul class="nav-main-submenu">

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ url('admin/secure/cms/privacy-policy') }}">
                                    <span class="nav-main-link-name">PRIVACY POLICY</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ url('admin/secure/cms/payment-policy') }}">
                                    <span class="nav-main-link-name">PAYMENT POLICY</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ url('admin/secure/cms/copyright-policy') }}">
                                    <span class="nav-main-link-name">COPYRIGHT POLICY</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ url('admin/secure/cms/tutor-policy') }}">
                                    <span class="nav-main-link-name">TUTOR POLICY</span>
                                </a>
                            </li>

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ url('admin/secure/cms/terms-of-service') }}">
                                    <span class="nav-main-link-name">TERMS OF SERVICE</span>
                                </a>
                            </li>


                        </ul>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-user-lock"></i>
                            <span class="nav-main-link-name">SETTINGS </span>
                        </a>
                        <ul class="nav-main-submenu">

                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('admin.user.password') }}">
                                    <span class="nav-main-link-name">Change Password</span>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-main-item">

                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                            <span class="nav-main-link-name">Logout</span>
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
                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                            <span>Profile</span>
                            <i class="fa fa-fw fa-person opacity-25"></i>
                        </a>
                        <!-- END Side Overlay -->

                        <div class="dropdown-divider"></div>
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
            <form class="w-100" action="#" method="POST">
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
