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
                            <h2 class="title">Upcoming Online Sessions</h2>
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Online Sessions</li>
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
                    @include('home.util.sidebar')
                    <div class="col-lg-9">

                        <!-- Course Top Bar Start -->
                        <div class="course-top-bar">
                            <div class="course-top-text">
                                <p>We found <span>{{$course->count()}}</span> Online Sessions For You</p>
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
