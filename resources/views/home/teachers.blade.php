@extends('home.template')
@section('content')

    <style>
        .single-course-list .course-image a img {
            width: 100px !important;
        }
    </style>

    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-color: #FACB27;">
        <div class="shape-3"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <br />
                        <h1>Tutor</h1>
                        <p>Learn your favourite languages with our relatable tutors. Find a tutor to guide you on your learning journey</p>
                        <br />
                    </div>
                    <div class="col-lg-4">
                        <img src="{{asset('banners/image5.png')}}" style="float: right" />

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

                                    @foreach($teachers as $row)
                                        @include('home.teacher_list')
                                    @endforeach


                                </div>
                                <!-- Course List End -->
                            </div>
                        </div>

                        <!-- Page Pagination Start -->
                        {{ $teachers->links('home.util.pagination') }}
                        <!-- Page Pagination End -->


                    </div>
                </div>
            </div>
            <!-- Course List Wrapper End -->

        </div>
    </div>
    <!-- Course List End -->


@endsection
