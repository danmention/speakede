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
                            <h2 class="title">Search</h2>
                            <ul class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Search</li>
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
                                @if($type === "course")
                                <p>We found <span>{{$course->count()}}</span> Courses For You</p>
                                @elseif($type === "tutors")
                                    <p>We found <span>{{$tutors->count()}}</span> Tutors For You</p>
                                @elseif($type === "group")
                                    <p>We found <span>{{$group->count()}}</span> Group Sessions For You</p>
                                @endif
                            </div>
                        </div>
                        <!-- Course Top Bar End -->



                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="grid">
                                <div class="row">

                                    @if($type === "course")
                                    @foreach($course as $row)
                                        <div class="col-lg-4 col-sm-6">
                                            @include('home.course_list')
                                        </div>
                                    @endforeach
                                    @elseif($type === "tutors")
                                        <div class="course-list-items">
                                            @foreach($tutors as $row)
                                                @include('home.teacher_list')
                                            @endforeach

                                        </div>
                                    @elseif($type === "group")
                                        @foreach($group as $row)
                                        <div class="col-lg-4 col-sm-6">
                                            @include('home.group_course_list')
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($type === "course")
                            <!-- Page Pagination Start -->
                            {{ $course->links('home.util.pagination') }}
                            <!-- Page Pagination End -->
                        @elseif($type === "tutors")
                            <!-- Page Pagination Start -->
                            {{ $tutors->links('home.util.pagination') }}
                            <!-- Page Pagination End -->
                        @elseif($type === "group")
                            <!-- Page Pagination Start -->
                            {{ $group->links('home.util.pagination') }}
                            <!-- Page Pagination End -->
                        @endif

                    </div>
                </div>
            </div>
            <!-- Course List Wrapper End -->

        </div>
    </div>
    <!-- Course List End -->


@endsection
