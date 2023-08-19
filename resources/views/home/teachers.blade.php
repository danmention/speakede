@extends('home.template')
@section('content')

    <style>
        .single-course-list .course-image a img {
            width: 100px !important;
        }
    </style>

    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-image: url({{asset("home/assets/images/bg/page-banner.jpg")}}">
        <div class="shape-3"></div>
        <div class="container">
            <div class="page-banner-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>Teachers</h1>
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

                                    @foreach($teachers as $row)
                                    <!-- Course List Start -->
                                    <div class="single-course-list">
                                        <div class="course-image">

                                            @if(!empty($row->profile_image))
                                                <a href="{{url('teacher/'.$row->identity)}}"> <img src="{{asset('profile/photo/'.$row->id.'/'.$row->profile_image)}}" class="img-avatar" alt="author" style="width: 80px"></a>
                                            @else
                                                <a href="{{url('teacher/'.$row->identity)}}"> <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author" style="width: 80px"></a>
                                            @endif
                                        </div>
                                        <div class="course-content">
                                            <div style="margin-bottom: 10px">
                                                <h3 class="title"><a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}}</a></h3>
                                                <span class="author-name">PROFESSIONAL TEACHER</span>
                                            </div>

                                            <div class="top-meta">
                                                <a class="tag" href="#">SPEAKS</a>
                                                @foreach($row["preferred_lang"] as $rw)
                                                    <span class="language">{{$rw->title}}</span>
                                                @endforeach

                                            </div>

                                            <p>{!! $row->about_me !!}</p>
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
