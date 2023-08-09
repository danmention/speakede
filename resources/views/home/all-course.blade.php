@extends('home.template')
@section('content')

    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-image: url({{asset("home/assets/images/bg/page-banner.jpg")}});">
        <div class="shape-3"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Banner Content Start -->
                        <div class="page-banner text-center">
                            <h2 class="title">Course Sidebar</h2>
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Course Sidebar</li>
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
                                <h3 class="widget-title">Type of Courses</h3>

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
                                <h3 class="widget-title">Categories</h3>

                                <div class="widget-checkbox">
                                    <ul class="checkbox-list">
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox3">
                                            <label class="form-check-label" for="checkbox3">Technology (11)</label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox4">
                                            <label class="form-check-label" for="checkbox4">Business (07)</label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox5">
                                            <label class="form-check-label" for="checkbox5">Development (11)</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Wrapper End -->

                            <!-- Sidebar Wrapper Start -->
                            <div class="sidebar-widget-02">
                                <h3 class="widget-title">Instructor</h3>

                                <div class="widget-checkbox">
                                    <ul class="checkbox-list">
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox6">
                                            <label class="form-check-label" for="checkbox6">Jimmy Jason (11)</label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox7">
                                            <label class="form-check-label" for="checkbox7">Harnold (07)</label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox8">
                                            <label class="form-check-label" for="checkbox8">Eric Madny (11)</label>
                                        </li>
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

                            <!-- Sidebar Wrapper Start -->
                            <div class="sidebar-widget-02">
                                <h3 class="widget-title">Lavel</h3>

                                <div class="widget-checkbox">
                                    <ul class="checkbox-list">
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox12">
                                            <label class="form-check-label" for="checkbox12">Beginner (11)</label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox13">
                                            <label class="form-check-label" for="checkbox13">Advanced (07)</label>
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
                                <p>We found <span>78</span> Courses For You</p>
                            </div>
                            <div class="course-top-inner">
                                <div class="course-top-menu">
                                    <ul class="nav">
                                        <li><button class="active" data-bs-toggle="tab" data-bs-target="#grid"><i class="fa fa-th-large"></i></button></li>
                                        <li><button data-bs-toggle="tab" data-bs-target="#list"><i class="fa fa-th-list"></i></button></li>
                                    </ul>
                                </div>
                                <div class="course-collapse-btn">
                                    <button class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFilters">
                                        <i class="fa fa-filter"></i>
                                        Sort by : <span>Default </span>
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Course Top Bar End -->



                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="grid">
                                <div class="row">
                                    @foreach($course as $row)
                                        <div class="col-lg-4 col-sm-6">
                                            @include('home.course_list')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Page Pagination Start -->
                        <div class="upstudy-pagination">
                            <ul class="pagination justify-content-center">
                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                <li><a class="active" href="course-grid.html">1</a></li>
                                <li><a href="course-grid.html">2</a></li>
                                <li><a href="course-grid.html">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="course-grid.html"><i class="fa fa-angle-right"></i></a></li>
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
