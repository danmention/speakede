@extends('home.template')
@section('content')

    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-image: url({{asset("home/assets/images/bg/page-banner.jpg")}});">
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Banner Content Start -->
                        <div class="page-banner text-center">
                            <h2 class="title">Group Classes</h2>
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Group Classes</li>
                            </ul>
                        </div>
                        <!-- Page Banner Content End -->
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
                    <div class="col-lg-3">
                        <!-- Sidebar Wrapper Start -->
                        <div class="sidebar-wrap-02">

                            <!-- Sidebar Wrapper Start -->
                            <div class="sidebar-widget-02">
                                <h3 class="widget-title">Type of Group Courses</h3>

                                <div class="widget-checkbox">
                                    <ul class="checkbox-list">
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox1">
                                            <label class="form-check-label" for="checkbox1">Free (11)</label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox2">
                                            <label class="form-check-label" for="checkbox2">Paid (11)</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Wrapper End -->


                            <!-- Sidebar Wrapper Start -->
                            <div class="sidebar-widget-02">
                                <h3 class="widget-title">Language</h3>

                                <div class="widget-checkbox">
                                    <ul class="checkbox-list">

                                        @foreach($lang as $lan)
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox6">
                                            <label class="form-check-label" for="checkbox6">{{$lan->title}}</label>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Wrapper End -->

                            <!-- Sidebar Wrapper Start -->
                            <div class="sidebar-widget-02">
                                <h3 class="widget-title">Ratings</h3>

                                <div class="widget-checkbox">
                                    <ul class="checkbox-list">
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox9">
                                            <label class="form-check-label" for="checkbox9">
                                                <div class="rating">
                                                    <div class="rating-on" style="width: 100%;"></div>
                                                </div> (4.5)
                                            </label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                            <label class="form-check-label" for="checkbox10">
                                                <div class="rating">
                                                    <div class="rating-on" style="width: 60%;"></div>
                                                </div> (3.5)
                                            </label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox11">
                                            <label class="form-check-label" for="checkbox11">
                                                <div class="rating">
                                                    <div class="rating-on" style="width: 40%;"></div>
                                                </div> (2)
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Wrapper End -->

                        </div>
                        <!-- Sidebar Wrapper End -->
                    </div>
                    <div class="col-lg-9">

                        <!-- Course Top Bar Start -->
                        <div class="course-top-bar">
                            <div class="course-top-text">
                                <p>We found <span>{{$course->count()}}</span> Group Classes For You</p>
                            </div>

                        </div>
                        <!-- Course Top Bar End -->



                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="grid">
                                <div class="row">
                                    @foreach($course as $row)
                                        <div class="col-lg-4 col-sm-6">
                                            @include('home.group_course_list')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- Page Pagination Start -->
                        {{ $course->links('home.util.pagination') }}
                        <!-- Page Pagination End -->

                    </div>
                </div>
            </div>
            <!-- Course List Wrapper End -->

        </div>
    </div>
    <!-- Course List End -->


@endsection
