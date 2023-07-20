


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Speakede</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
                                <li><a href="#">Find a teacher</a></li>
                                <li><a href="#">Group Class</a></li>
                                <li><a href="#">Community</a></li>
                                <li><a href="{{url('become-a-teacher')}}">Become a teacher</a></li>
                            </ul>
                        </div>
                        <!--  Header Menu End  -->

                    </div>


                    <!-- Header Meta Start -->
                    <div class="header-meta">
                        <div class="header-search d-none d-xl-block">
                            <form action="#">
                                <input type="text" placeholder="Search Courses">
                                <button><i class="flaticon-loupe"></i></button>
                            </form>
                        </div>

                        <div class="header-login d-none d-lg-block">
                            <a class="link" href="{{route('index.login')}}"><i class="far fa-user"></i> Login</a>
                            <a class="link" href="{{route('index.register')}}">Register</a>
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
                    <li><a href="{{url('teachers/english')}}">Find a teacher</a></li>
                    <li><a href="{{url('group-class/english')}}">Group Class</a></li>
                    <li><a href="{{url('community')}}">Community</a></li>
                    <li><a href="{{url('become-a-teacher')}}">Become a teacher</a></li>
                    <li><a href="{{route('index.login')}}">Login</a></li>
                    <li><a href="{{route('index.register')}}">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Offcanvas End -->
