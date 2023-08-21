@extends('home.template')
@section('content')


        <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-image: url({{asset("home/assets/images/bg/page-banner.jpg")}});">
        <div class="container">

            @foreach($course as $row)
                <!-- Course Details Banner Content Start -->
                <div class="course-details-banner-content">

                    <h2 class="title">{{ucwords($row->title)}} </h2>

                    <div class="course-details-meta">
                        @foreach($profile as $rw)
                            <div class="meta-action">

                                @if(!empty($rw->profile_image))
                                    <div class="meta-author">
                                        <img src="{{asset('profile/photo/'.$rw->id.'/'.$rw->profile_image)}}" class="img-avatar" alt="author" style="width: 80px;">
                                    </div>
                                @else
                                    <div class="meta-author">
                                        <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author">
                                    </div>
                                @endif
                                <div class="meta-name">
                                    <p class="name">{{$row->instructor[0]["firstname"].' '.$row->instructor[0]["lastname"]}}</p>
                                </div>
                            </div>
                            <div class="meta-action">
                                <div class="rating">
                                    <div class="rating-star">
                                        <div class="rating-active" style="width: {{$row->rating}}%;"></div>
                                    </div>
                                    <span>({{$row->rating}})</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Course Details Banner Content End -->
            @endforeach
        </div>
    </div>
    <!-- Page Banner End -->

    <!-- Course Details Start -->
    <div class="section section-padding">
        <div class="container">

            @foreach($course as $row)
                <div class="row justify-content-between">
                    <div class="col-xl-7 col-lg-8">
                        <!-- Course Details Wrapper Start -->
                        <div class="course-details-wrapper">

                            <!-- Course Overview Start -->
                            <div class="course-overview">
                                <h3 class="title">Course Overview</h3>
                                {!! $row->description !!}
                            </div>
                            <!-- Course Overview End -->

                            <!-- Course Lessons Start -->
                            <div class="course-lessons">


                                <!-- Course Instructor Start -->
                                <div class="course-instructor">
                                    <h3 class="title">Course Instructor</h3>

                                    <div class="instructor-profile">
                                        @foreach($profile as $instructor)
                                            <div class="profile-images">

                                                @if(!empty($instructor->profile_image))
                                                    <div class="figure mb-3">
                                                        <img src="{{asset('profile/photo/'.$instructor->id.'/'.$instructor->profile_image)}}" class="img-avatar" alt="author" style="width: 80px;">
                                                    </div>
                                                @else
                                                    <div class="figure mb-3">
                                                        <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author" style="width: 80px;">
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="profile-content">
                                                <h5 class="name"><a href="{{url('teacher/'.$instructor->identity)}}">{{$instructor->firstname. ' '.$instructor->lastname}}</a> </h5>

                                                <div class="profile-meta">
                                                    <div class="rating">
                                                        <div class="rating-star">
                                                            <div class="rating-active" style="width: {{$row->rating}}%;"></div>
                                                        </div>
                                                        <span>({{$row->rating}})</span>
                                                    </div>
                                                    <span class="meta-action"><i class="fa fa-play-circle"></i> 10 Tutorials</span>
                                                    <span class="meta-action"><i class="far fa-user"></i> 134 Students</span>
                                                </div>

                                                <p>{!! $instructor->about_me !!}</p>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Course Instructor End -->
                            </div>
                            <!-- Course Lessons End -->


                        </div>
                        <!-- Course Details Wrapper End -->

                    </div>

                    <div class="col-lg-4">

                        <!-- Sidebar Wrapper Start -->
                        <div class="sidebar-details-wrap">

                            <!-- Sidebar Details Video Description Start -->
                            <div class="sidebar-details-video-description">
                                <div class="sidebar-video">
                                    <img src="{{asset('group/class/photo/'.$row->user_id.'/'.$row->cover_image)}}" class="img-avatar">

                                </div>
                                <div class="sidebar-description">
                                    <div class="price-wrap">
                                        <span class="label">Price  :</span>
                                        <div class="price">
                                            <span class="sale-price">₦ {{number_format($row->price)}}</span>
                                        </div>
                                    </div>
                                    <ul class="description-list">
                                        <li><i class="flaticon-wall-clock"></i> Duration <span>{{ \Carbon\Carbon::parse($row->start_date)->format(' H:i')}}  -  {{\Carbon\Carbon::parse($row->start_date)->addMinutes($row->duration_in_mins)->format(' H:i')}} {{ \Carbon\Carbon::parse($row->start_date)->format('M D Y')}}</span></li>
                                        <li><i class="fas fa-sliders-h"></i> Level <span>Expert</span></li>
                                    </ul>

                                    @if(\Illuminate\Support\Facades\Auth::user())

                                        @if(Auth::user()->id == $row->user_id)
                                            <a class="btn w-100" href="{{route('user.group.class.all')}}">View</a>
                                        @else
                                        <a class="btn w-100" href="{{ url('user/apply/booking/group/lesson/pay?teacher_id='.$row->identity.'&slot='.$row->slot.'&id='.$row->id) }}">Buy</a>
                                        @endif
                                    @else
                                        <a class="btn w-100" href="{{url('login')}}">Buy</a>
                                    @endif
                                    <div class="share-link">
                                        <div class="link-icon">
                                            <i class="fas fa-share-alt"></i>
                                        </div>
                                        <a class="share-btn" href="#"> Share This Course</a>
                                        <div class="social-share-wrapper">
                                            <ul>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar Details Video Description End -->


                        </div>
                        <!-- Sidebar Wrapper End -->
                    </div>
                </div>

            @endforeach

        </div>
    </div>
    <!-- Course Details End -->

@endsection
