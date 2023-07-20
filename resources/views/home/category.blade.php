@extends('home.template')
@section('content')

    <style>
        .single-course-list .course-image a img {
            width: 100px !important;
        }
    </style>

    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-image: url({{asset("home/assets/images/bg/page-banner.jpg")}}">
        <div class="shape-1">
            <img src="{{asset("home/assets/images/shape/shape-7.png")}}" alt="">
        </div>
        <div class="shape-2">
            <img src="{{asset("home/assets/images/shape/shape-1.png")}}" alt="">
        </div>
        <div class="shape-3"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>The best English tutor for you</h1>
                        <p>Looking for a great way to improve your English? italki provides you with qualified English teachers. Hire an online English tutor to help you learn English</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{asset('class_logo.svg')}}" style="float: right" />

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Banner End -->


    <!-- Course List Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- Course List Wrapper Start -->
            <div class="course-list-wrapper">
                <div class="row">

                    <div class="col-lg-9">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="list">
                                <!-- Course List Start -->
                                <div class="course-list-items">

                                    <!-- Course List Start -->
                                    <div class="single-course-list">
                                        <div class="course-image">
                                            <a href="{{url('teacher/9109019/english')}}"><img src="{{asset("home/192-1925180_student-circle-student-images-in-a-circle-hd.png")}}" alt="Courses"></a>
                                        </div>
                                        <div class="course-content">
                                            <div style="margin-bottom: 10px">
                                                <h3 class="title"><a href="{{url('teacher/9109019/english')}}">Ilias Brahim</a></h3>
                                                <span class="author-name">PROFESSIONAL TEACHER</span>
                                            </div>

                                            <div class="top-meta">
                                                <a class="tag" href="#">SPEAKS</a>
                                                <span class="sale-price">ENGLISH</span>
                                            </div>

                                            <p>Managing a popular open source project can be daunting at first. How do we maintain all these issues, or automatically trigger</p>

                                            <div class="bottom-meta">
                                                <p class="meta-action"><i class="far fa-user"></i> 79</p>
                                                <p class="meta-action"><i class="far fa-clock"></i> 2h 20min</p>
                                                <div class="rating">
                                                    <div class="rating-star">
                                                        <div class="rating-active" style="width: 60%;"></div>
                                                    </div>
                                                    <span>(4.5)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Course List End -->

                                    <!-- Course List Start -->
                                    <div class="single-course-list">
                                        <div class="course-image">
                                            <a href="{{url('teacher/9109019/english')}}"><img src="{{asset("home/assets/images/courses/courses-2.jpg")}}" alt="Courses"></a>
                                        </div>
                                        <div class="course-content">
                                            <div class="top-meta">
                                                <a class="tag" href="#">Beginner</a>
                                                <span class="price">
                                                      <span class="sale-price">$49</span>
                                                    </span>
                                            </div>
                                            <h3 class="title"><a href="{{url('teacher/9109019/english')}}">Learn PHP Programming From Scratch</a></h3>
                                            <span class="author-name">Daziy Millar</span>

                                            <p>Managing a popular open source project can be daunting at first. How do we maintain all these issues, or automatically trigger</p>

                                            <div class="bottom-meta">
                                                <p class="meta-action"><i class="far fa-user"></i> 79</p>
                                                <p class="meta-action"><i class="far fa-clock"></i> 2h 20min</p>
                                                <div class="rating">
                                                    <div class="rating-star">
                                                        <div class="rating-active" style="width: 60%;"></div>
                                                    </div>
                                                    <span>(4.5)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Course List End -->

                                    <!-- Course List Start -->
                                    <div class="single-course-list">
                                        <div class="course-image">
                                            <a href="{{url('teacher/9109019/english')}}"><img src="{{asset("home/assets/images/courses/courses-3.jpg")}}" alt="Courses"></a>
                                        </div>
                                        <div class="course-content">
                                            <div class="top-meta">
                                                <a class="tag" href="#">Beginner</a>
                                                <span class="price">
                                                       <span class="sale-price">$29</span>
                                                    </span>
                                            </div>
                                            <h3 class="title"><a href="{{url('teacher/9109019/english')}}">The Complete JavaScript Course for Beginner</a></h3>
                                            <span class="author-name">Andrew paker</span>

                                            <p>Managing a popular open source project can be daunting at first. How do we maintain all these issues, or automatically trigger</p>

                                            <div class="bottom-meta">
                                                <p class="meta-action"><i class="far fa-user"></i> 79</p>
                                                <p class="meta-action"><i class="far fa-clock"></i> 2h 20min</p>
                                                <div class="rating">
                                                    <div class="rating-star">
                                                        <div class="rating-active" style="width: 60%;"></div>
                                                    </div>
                                                    <span>(4.5)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Course List End -->

                                </div>
                                <!-- Course List End -->
                            </div>
                        </div>

                        <!-- Page Pagination Start -->
                        <div class="upstudy-pagination">
                            <ul class="pagination justify-content-center">
                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                <li><a class="active" href="course-list.html">1</a></li>
                                <li><a href="course-list.html">2</a></li>
                                <li><a href="course-list.html">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="course-list.html"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <!-- Page Pagination End -->

                    </div>
                </div>
            </div>
            <!-- Course List Wrapper End -->

        </div>
    </div>
    <!-- Course List End -->


@endsection
