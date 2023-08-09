@extends('home.template')
@section('content')

    @php

        use App\Models\Lesson;
    @endphp

    <!-- Page Banner Start -->
    <div class="section page-banner-section" style="background-image: url({{asset("home/assets/images/bg/page-banner.jpg")}});">
        <div class="shape-1">
            <img src="{{asset("home/assets/images/shape/shape-7.png")}}" alt="">
        </div>
        <div class="shape-2">
            <img src="{{asset("home/assets/images/shape/shape-1.png")}}" alt="">
        </div>
        <div class="shape-3"></div>
        <div class="container">

            @foreach($course as $row)
            <!-- Course Details Banner Content Start -->
            <div class="course-details-banner-content">

                <h2 class="title">{{ucwords($row->title)}} </h2>


                <div class="course-details-meta">
                    <div class="meta-action">
                        <div class="meta-author">
                            <img src="{{asset("home/assets/images/author-3.jpg")}}" alt="Author">
                        </div>
                        <div class="meta-name">
                            <p class="name">{{$row->instructor[0]["firstname"].' '.$row->instructor[0]["lastname"]}}</p>
                        </div>
                    </div>
                    <div class="meta-action">
                        <div class="rating">
                            <div class="rating-star">
                                <div class="rating-active" style="width: 100%;"></div>
                            </div>
                            <span>(4.5)</span>
                        </div>
                    </div>
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

            <div class="row justify-content-between">
                <div class="col-xl-7 col-lg-8">

                    @foreach($course as $row)
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

                            <div class="lessons-top">
                                <h3 class="title">Course Content</h3>
                                <div class="lessons-time">
                                    <span>{{$row->lesson_total}} Lessons</span>
                                    <span>{{$row->course_duration}}</span>
                                </div>
                            </div>

                            <!-- Course Accordion Start -->
                            <div class="course-accordion accordion" id="accordionCourse">

                                <?php $x = 0; ?>
                                @foreach($lessons as $rw)
                                    <?php $x++;?>
                                <div class="accordion-item">
                                    <button  class="{{ $x == 1 ? "" : "collapsed" }}" data-bs-toggle="collapse" data-bs-target="#collapse{{$rw->id}}">{{$rw->lesson_name}} </button>
                                    <div id="collapse{{$rw->id}}" class="accordion-collapse collapse {{ $x == 1 ? "show" : "" }}" data-bs-parent="#accordionCourse">
                                        <div class="accordion-body">
                                            <ul class="lessons-list">
                                                @foreach(Lesson::query()->where('group_id', $rw->group_id)->get() as $lesson)
                                                    <li><a href=""><i class="fa fa-play-circle"></i> {{$lesson->lesson_title}} <span>5:00</span></a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <!-- Course Accordion End -->


                            <br />
                            @if(isset(Auth::user()->id) && (Auth::user()->is_admin == 0))
                                <div class="contact-form-wrap">
                                    <h3>Leave A Review</h3>

                                    <form action="{{route('index.user.review.save')}}" method="POST" class="candidates-leave-comment">
                                        {{ csrf_field() }}



                                        <div class="rating">
                                            <input name="rating" class="stars" type="radio" value="5" style="margin-right: 5px;">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 100%;"></div>
                                            </div>
                                        </div>

                                        <div class="rating">
                                            <input name="rating" class="stars" type="radio" value="5" style="margin-right: 5px;">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 80%;"></div>
                                            </div>
                                        </div>

                                        <div class="rating">
                                            <input name="rating" class="stars" type="radio" value="5" style="margin-right: 5px;">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 60%;"></div>
                                            </div>
                                        </div>

                                        <div class="rating">
                                            <input name="rating" class="stars" type="radio" value="5" style="margin-right: 5px;">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 40%;"></div>
                                            </div>
                                        </div>

                                        <div class="rating">
                                            <input name="rating" class="stars" type="radio" value="5" style="margin-right: 5px;">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 20%;"></div>
                                            </div>
                                        </div>

                                        <div class="rating">
                                            <input name="rating" class="stars" type="radio" value="5" style="margin-right: 5px;">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 10%;"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="single-form">
                                                    <input type="text" class="form-control" name="fullname" placeholder="Your Name">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="single-form">
                                                    <input type="text" class="form-control" name="email" placeholder="Your Email">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="single-form">
                                                    <textarea name="review" class="form-control" placeholder="Your Review"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <p class="form-cookies-consent">
                                                    <input type="checkbox" id="test1">
                                                    <label for="test1">I Accept All <a href="#" target="_blank">Terms & Conditions</a></label>
                                                </p>
                                            </div>

                                            <input type="hidden" name="rating_pro" value="rating">
                                            <input type="hidden" value="{{\Illuminate\Support\Facades\Request::segment(2)}}" name="user_id"/>


                                            <div class="form-btn">
                                                <button class="btn" type="submit">Post A Review</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            @endif

                        </div>
                        <!-- Course Lessons End -->

                        <!-- Course Instructor Start -->
                        <div class="course-instructor">
                            <h3 class="title">Course Instructor</h3>

                            <div class="instructor-profile">

                                @foreach($profile as $row)
                                <div class="profile-images">

                                    @if(!empty($row->profile_image))
                                        <div class="figure mb-3">
                                            <img src="{{asset('profile/photo/'.$row->id.'/'.$row->profile_image)}}" class="img-avatar" alt="author">
                                        </div>
                                    @else
                                        <div class="figure mb-3">
                                            <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author">
                                        </div>
                                    @endif

                                </div>
                                <div class="profile-content">
                                    <h5 class="name"><a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}}</a> </h5>

                                    <div class="profile-meta">
                                        <div class="rating">
                                            <div class="rating-star">
                                                <div class="rating-active" style="width: 100%;"></div>
                                            </div>
                                            <span>(4.6)</span>
                                        </div>
                                        <span class="meta-action"><i class="fa fa-play-circle"></i> 10 Tutorials</span>
                                        <span class="meta-action"><i class="far fa-user"></i> 134 Students</span>
                                    </div>

                                    <p>{!! $row->about_me !!}</p>

                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Course Instructor End -->

                    </div>
                    <!-- Course Details Wrapper End -->
                    @endforeach

                </div>

                <div class="col-lg-4">

                    @foreach($course as $row)
                    <!-- Sidebar Wrapper Start -->
                    <div class="sidebar-details-wrap">

                        <!-- Sidebar Details Video Description Start -->
                        <div class="sidebar-details-video-description">
                            <div class="sidebar-video">
                                <iframe width="378" height="248" src="https://www.youtube.com/embed/{{substr($row->youtube_link, strpos($row->youtube_link, "watch?v=") + strlen("watch?v="))}}?rel=0&amp;controls=1&amp&amp;showinfo=0&amp;modestbranding=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                                         encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                            </div>
                            <div class="sidebar-description">
                                <div class="price-wrap">
                                    <span class="label">Price  :</span>
                                    <div class="price">
                                        <span class="sale-price">₦ {{number_format($row->price)}}</span>
                                    </div>
                                </div>
                                <ul class="description-list">
                                    <li><i class="flaticon-wall-clock"></i> Duration <span>{{$row->course_duration}}</span></li>
                                    <li><i class="fas fa-sliders-h"></i> Level <span>Expert</span></li>
                                    <li><i class="far fa-file-alt"></i> Lectures <span>{{$row->lesson_total}} Lectures</span></li>
                                    <li><i class="fas fa-language"></i> Language <span>{{$row->language}}</span></li>
                                </ul>

                                @if(\Illuminate\Support\Facades\Auth::user())
                                    <a class="btn w-100" href="{{url('user/course/buy/'.$row->id)}}">Buy</a>
                                @else
                                    <a class="btn w-100" href="{{url('register')}}">Buy</a>
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
                    @endforeach
                </div>
            </div>


        </div>
    </div>
    <!-- Course Details End -->

@endsection
