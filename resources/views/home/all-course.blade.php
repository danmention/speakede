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
                            <h2 class="title">Courses</h2>
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Courses</li>
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
                                             <input class="form-check-input" type="checkbox" value="free" name="type" id="checkbox1">
                                            <label class="form-check-label" for="checkbox1">Free ({{$free_course}})</label>
                                        </li>
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="paid" name="type" id="checkbox2">
                                            <label class="form-check-label" for="checkbox2">Paid ({{$paid_course}})</label>
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

                                        @foreach($instructors as $row)
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkbox6">
                                            <label class="form-check-label" for="checkbox6">{{$row->firstname.' '.$row->lastname}} ({{$row->number_of_course}})</label>
                                        </li>
                                        @endforeach
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
                                <p>We found <span>{{$course->count()}}</span> Courses For You</p>
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
