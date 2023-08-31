@extends('home.template')
@section('content')

    <!-- Team Profile Start -->
    <div class="section upstudy-team-profile-section section-padding">
        <div class="container">
            <div class="team-profile-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Team Profile Description Wrap Start -->
                        <div class="team-profile-description-wrap">
                            <!-- Team Profile Info Start -->
                            <div class="team-profile-info">

                                @foreach($profile as $row)
                                    <div class="instructor-profile">


                                        <div class="profile-images">

                                            @if(!empty($row->profile_image))
                                                <div class="figure mb-3">
                                                    <img
                                                        src="{{asset('profile/photo/'.$row->id.'/'.$row->profile_image)}}"
                                                        class="img-avatar" alt="author" style="width: 80px">
                                                </div>
                                            @else
                                                <div class="figure mb-3">
                                                    <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author"
                                                         style="width: 80px">
                                                </div>
                                            @endif

                                        </div>
                                        <div class="profile-content">
                                            <h5 class="name"><a
                                                    href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}}</a>
                                            </h5>

                                            <p>PROFESSIONAL TEACHER</p>
                                            <p>Teaches:</p>

                                            @foreach($preferred_lang as $rw)
                                                <span class="language">{{$rw->title}}</span>
                                            @endforeach


                                            <p>Speaks:</p>

                                            @foreach($language_i_speak as $rws)
                                                <span class="language">{{$rws->title}}</span>
                                            @endforeach

                                        </div>

                                    </div>

                            </div>
                            <!-- Team Profile Info End -->

                            <div class="col-lg-10">
                                <div class="team-profile-description">
                                    <h3 class="title">About Me</h3>
                                    <p>{!! $row->about_me !!}</p>
                                </div>
                            </div>


                            <div class="col-lg-10">
                                <div class="team-profile-description">
                                    <h3 class="title"> Availability</h3>
                                    <br/>

                                    <div class="block-content block-content-full space-y-3 row">
                                        <div class="form-check form-block col-lg-6" id="private_class">
                                            <input type="radio" class="form-check-input" id="checkout-delivery-1"
                                                   name="checkout-delivery" checked="">
                                            <label class="form-check-label" for="checkout-delivery-1">
                                            <span class="d-block fw-normal p-1">
                                              <span class="d-block fw-semibold mb-1">Private Class</span>
                                              <span class="d-block fs-sm fw-medium text-muted">PAID</span>
                                            </span>
                                            </label>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                            </div>

                            <div class="col-lg-10" id="private_class_view">
                                <!-- Team Profile Start -->
                                <div class="team-profile text-center">
                                    <div id="calendar"></div>
                                </div>
                                <!-- Team Profile End -->
                            </div>


{{--                            <div class="col-lg-10" id="group_class_view" style="display: none;">--}}
{{--                                <!-- Team Profile Start -->--}}

{{--                                @if(!empty($private_class[0]))--}}
{{--                                    @if($private_class[0]->available_slots == 0)--}}
{{--                                        <div class="group_class">--}}
{{--                                            <div class="image-text">--}}
{{--                                                <h2>Group Class is no longer Available</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        <div class="group_class">--}}
{{--                                            <div class="image-text">--}}
{{--                                                <h3 class="number">{{$private_class[0]->title}}</h3>--}}
{{--                                                <p>{!! $private_class[0]->description !!}</p>--}}

{{--                                                <h4>Price : ₦{{ number_format($private_class[0]->price)}}</h4>--}}

{{--                                                <a href="{{ url('user/apply/booking/group/lesson/pay?teacher_id='.$identity.'&slot='.$private_class[0]->slot.'&id='.$private_class[0]->id) }}"--}}
{{--                                                   style="margin-top: 0px !important;background: #e1ac4b;color: #ffffff;padding: 8px;border-radius:6px;"--}}
{{--                                                   class="ml-2">--}}
{{--                                                    <strong>Book Now</strong>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                                    <!-- Team Profile End -->--}}
{{--                            </div>--}}

                            <!-- Team Profile Description Start -->

                            <br />
                            <div class="col-lg-10">

                                @if($reviews->count() > 0)
                                    <h3 class="title">Reviews</h3>
                                @endif
                                <!-- Review Item Start -->
                                <div class="review-items">
                                    <ul>
                                        @foreach($reviews as $review)
                                            <li>
                                                <!-- Single Review Start -->
                                                <div class="single-review">
                                                    <div class="review-author">

                                                        @if(!empty($review->profile_image))
                                                            <div class="figure mb-3">
                                                                <img src="{{asset('profile/photo/'.$review->user_id.'/'.$review->profile_image)}}" alt="author">
                                                            </div>
                                                        @else
                                                            <div class="figure mb-3">
                                                                <img src="{{asset('avater2.png')}}" alt="author">
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="review-content">
                                                        <div class="review-top">
                                                            <h4 class="name">{{$review->fullname}}</h4>
                                                            <div class="rating-star">
                                                                <div class="rating-active" style="width: {{$review->rating * 20}}%;"></div>
                                                            </div>
                                                            <span class="date">{{$review->created_at}}</span>
                                                        </div>
                                                        <p>{{$review->review}}.</p>
                                                    </div>
                                                </div>
                                                <!-- Single Review End -->
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Review Item End -->

                                <br />
                                @if(isset(Auth::user()->id) && (Auth::user()->is_admin == 0))
                                    <div class="contact-form-wrap">
                                        <h3>Leave A Review </h3>

                                        @if(Session::has('message'))
                                            <div class="notification-alert-danger alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ Session::get('message') }}
                                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif

                                        <form action="{{route('index.user.review.save')}}" method="POST" class="candidates-leave-comment">
                                            {{ csrf_field() }}

                                            <div class="rating">
                                                <input name="rating" class="stars" type="radio" value="5" style="margin-right: 5px;" required="required">
                                                <div class="rating-star">
                                                    <div class="rating-active" style="width: 100%;"></div>
                                                </div>
                                            </div>

                                            <div class="rating">
                                                <input name="rating" class="stars" type="radio" value="4" style="margin-right: 5px;" required="required">
                                                <div class="rating-star">
                                                    <div class="rating-active" style="width: 80%;"></div>
                                                </div>
                                            </div>

                                            <div class="rating">
                                                <input name="rating" class="stars" type="radio" value="3" style="margin-right: 5px;" required="required">
                                                <div class="rating-star">
                                                    <div class="rating-active" style="width: 60%;"></div>
                                                </div>
                                            </div>

                                            <div class="rating">
                                                <input name="rating" class="stars" type="radio" value="2" style="margin-right: 5px;" required="required">
                                                <div class="rating-star">
                                                    <div class="rating-active" style="width: 40%;"></div>
                                                </div>
                                            </div>

                                            <div class="rating">
                                                <input name="rating" class="stars" type="radio" value="1" style="margin-right: 5px;" required="required">
                                                <div class="rating-star">
                                                    <div class="rating-active" style="width: 20%;"></div>
                                                </div>
                                            </div>

                                            <div class="rating">
                                                <input name="rating" class="stars" type="radio" value="0" style="margin-right: 5px;" required="required">
                                                <div class="rating-star">
                                                    <div class="rating-active" style="width: 10%;"></div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="single-form">
                                                        <textarea name="review" class="form-control" placeholder="Your Review" required="required"></textarea>
                                                    </div>
                                                </div>


                                                <input type="hidden" name="rating_pro" value="rating">
                                                <input type="hidden" value="{{Auth::user()->id}}" name="user_id"/>
                                                <input type="hidden" value="{{$row->id}}" name="tutor_user_id"/>


                                                <div class="form-btn">
                                                    <button class="btn" type="submit">Post A Review</button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                @endif

                            </div>
                            <!-- Team Profile Description End -->

                        </div>
                        <!-- Team Profile Description Wrap End -->

                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Team Profile End -->

    @push('scripts')



    @endpush
@endsection
