@extends('home.template')
@section('content')




    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-color: #FACB27">
        <div class="shape-3"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <br />
                        <h1>All Courses</h1>
                        <p>Find the courses most suitable to your current language goals</p>
                        <br />
                    </div>
                    <div class="col-lg-4">
                        <img src="{{asset('banners/image6.png')}}" style="float: right" />

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
