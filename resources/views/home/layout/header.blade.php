


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

    <style>

        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .loading {
            position:fixed;
            z-index:9999;
            top: 0;
            left:-5px;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .loading-content {
            background-image: url("{{asset("logo-black.png")}}");
            background-repeat: no-repeat;
            background-size: contain;
            position: absolute;
            /*border: 16px solid #f3f3f3;*/
            /*border-top: 16px solid #3498db;*/
            width: 50px;
            height: 50px;
            top: 40%;
            left:50%;
            animation-name: fade-in;
            animation-duration: 3s;
            animation-timing-function: ease-in-out;
            animation-direction:alternate;
            animation-iteration-count: 5;
        }


    </style>


</head>

<body>

<section id="loading">
    <div id="loading-content"></div>
</section>

<div class="main-wrapper">

    <!-- Header Start  -->
    <div class="section header">
        <div class="header-bottom-section">

            <div class="container-fluid custom-container">
                <div class="header-bottom-wrap">

                    <div class="header-logo-menu">

                        <!--  Header Logo Start  -->
                        <div class="header-logo">
                            <a href="{{route('index.home')}}"><img src="{{asset("logo-black.png")}}" style="width: 50px" alt="logo"></a>
                        </div>
                        <!--  Header Logo End  -->

                        <!--  Header Menu Start  -->
                        <div class="header-menu d-none d-lg-block">
                            <ul class="main-menu">
                                <li><a href="{{route('index.find.tutor')}}">Find a tutor</a></li>
                                <li><a href="{{route('index.all.course')}}">All Courses</a></li>
                                <li><a href="{{route('index.all.online.sessions')}}">Online Sessions</a></li>
                                <li><a href="{{route('index.register')}}">Become a Tutor</a></li>
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
                                    <option value="course">courses</option>
                                    <option value="group">Online Sessions</option>
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
                <a href="{{url('/')}}"><img src="{{asset("logo-white.png")}}" style="width: 50px" alt="logo"></a>
            </div>
            <!-- Offcanvas Logo End -->

            <button type="button" class="close-btn" data-bs-dismiss="offcanvas"><i class="flaticon-close"></i></button>

        </div>
        <div class="offcanvas-body">
            <div class="offcanvas-menu">
                <ul class="main-menu">

                    <li><a href="{{route('index.find.tutor')}}">Find a tutor</a></li>
                    <li><a href="{{route('index.all.course')}}">All Courses</a></li>
                    <li><a href="{{route('index.all.online.sessions')}}">Online Sessions</a></li>
                    <li><a href="{{route('index.register')}}">Become a Tutor</a></li>

                    @if(isset(\Illuminate\Support\Facades\Auth::user()->is_admin) && \Illuminate\Support\Facades\Auth::user()->is_admin == 0)
                        <li> <a  href="{{route('user.dashboard')}}"><i class="far fa-user"></i> {{Auth::user()->firstname}}</a></li>
                        <li> <a href="{{route('account.logout')}}">Logout</a></li>

                    @else
                        <li> <a  href="{{route('index.login')}}"><i class="far fa-user"></i> Login</a></li>
                        <li> <a  href="{{route('index.register')}}">Signup</a></li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
    <!-- Offcanvas End -->
