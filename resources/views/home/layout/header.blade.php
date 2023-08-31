


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Speakede</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("home/img/cropped-speakede-icon-black-1-32x32.png")}}">

    <!-- CSS
	============================================ -->

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/flaticon.css")}}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/swiper-bundle.min.css")}}">
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/aos.css")}}">
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/nice-select.css")}}">
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/jquery.powertip.min.css")}}">
    <link rel="stylesheet" href="{{asset("home/assets/css/plugins/magnific-popup.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset("home/assets/css/style.css")}}">


</head>

<body>

<div class="main-wrapper">

    <!-- Header Start  -->
    <div class="section header">
        <div class="header-bottom-section">

            <div class="container-fluid custom-container">
                <div class="header-bottom-wrap">

                    <div class="header-logo-menu">

                        <!--  Header Logo Start  -->
                        <div class="header-logo">
                            <a href="{{url('/')}}"><img src="{{asset("home/img/cropped-speakede-icon-black-1-32x32.png")}}" alt="logo"></a>
                        </div>
                        <!--  Header Logo End  -->

                        <!--  Header Menu Start  -->
                        <div class="header-menu d-none d-lg-block">
                            <ul class="main-menu">
                                <li><a href="{{route('index.find.tutor')}}">Find a tutor</a></li>
                                <li><a href="{{route('index.all.course')}}">All Course</a></li>
                                <li><a href="{{route('index.all.online.sessions')}}">Upcoming Online Sessions</a></li>
                                <li><a href="{{route('index.register')}}">Become a teacher</a></li>
                            </ul>
                        </div>
                        <!--  Header Menu End  -->

                    </div>


                    <!-- Header Meta Start -->
                    <div class="header-meta">
                        <div class="header-search d-none d-xl-block">
                            <form  method="get" action="{{ route('search.now') }}">
                                {{ csrf_field() }}

                                <select name="type" style="background-color: #f3f3f3;padding: 0 20px;height: 55px;width: 30%;border: 1px solid transparent;color: #93a1a2;font-size: 15px;font-weight: 400;border-radius: 5px;">
                                    <option value=""> Select type</option>
                                    <option value="tutors">Tutors</option>
                                    <option value="course">Course</option>
                                    <option value="group">Upcoming (group) classes</option>
                                </select>

                                <input type="text" placeholder="Search" name="keyword" style="width: 62%;">
                                <button><i class="flaticon-loupe"></i></button>


                            </form>
                        </div>

                        <div class="header-login d-none d-lg-block">
                        @if(isset(\Illuminate\Support\Facades\Auth::user()->is_admin) && \Illuminate\Support\Facades\Auth::user()->is_admin == 0)
                            <a class="link" href="{{route('user.dashboard')}}"><i class="far fa-user"></i> {{Auth::user()->firstname}}</a>
                            <a class="link" href="{{route('account.logout')}}">Logout</a>

                        @else
                            <a class="link" href="{{route('index.login')}}"><i class="far fa-user"></i> Login</a>
                            <a class="link" href="{{route('index.register')}}">Signup</a>
                        @endif
                        </div>

                        <div class="header-toggle d-lg-none">
                            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                    </div>
                    <!-- Header Meta End -->

                </div>
            </div>


        </div>
    </div>
    <!-- Header End -->


    <!-- Offcanvas Start -->
    <div class="offcanvas offcanvas-start" id="offcanvasMenu">

        <div class="offcanvas-header">
            <!-- Offcanvas Logo Start -->
            <div class="offcanvas-logo">
                <a href="{{url('/')}}"><img src="{{asset("home/assets/images/logo-white.png")}}" alt=""></a>
            </div>
            <!-- Offcanvas Logo End -->

            <button type="button" class="close-btn" data-bs-dismiss="offcanvas"><i class="flaticon-close"></i></button>

        </div>
        <div class="offcanvas-body">
            <div class="offcanvas-menu">
                <ul class="main-menu">
                    <li><a href="{{route('index.find.tutor')}}">Find a tutor</a></li>
                    <li><a href="{{route('index.register')}}">Become a teacher</a></li>
                    <li><a href="{{route('index.login')}}">Login</a></li>
                    <li><a href="{{route('index.register')}}">Signup</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Offcanvas End -->
