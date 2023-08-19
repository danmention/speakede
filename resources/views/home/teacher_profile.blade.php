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

                                        </div>

                                    </div>

                            </div>
                            <!-- Team Profile Info End -->
                            <!-- Team Profile Description Start -->
                            <div class="col-lg-10">
                                <div class="team-profile-description">
                                    <h3 class="title">About Me</h3>
                                    <p>{!! $row->about_me !!}</p>
                                </div>
                            </div>
                            <!-- Team Profile Description End -->
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

                                        @if($private_class->count() > 0)
                                            <div class="form-check form-block col-lg-6" id="group_class">
                                                <input type="radio" class="form-check-input" id="checkout-delivery-2"
                                                       name="checkout-delivery">
                                                <label class="form-check-label" for="checkout-delivery-2">
                                                <span class="d-block fw-normal p-1">
                                                  <span class="d-block fw-semibold mb-1">
                                                    Group Class
                                                    <i class="fa fa-fire text-danger ms-1"></i>
                                                  </span>
                                                  <span class="d-block fs-sm fw-medium text-muted">{{$private_class[0]->available_slots}} Slot available</span>
                                                </span>
                                                </label>
                                            </div>
                                        @endif
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


                            <div class="col-lg-10" id="group_class_view" style="display: none;">
                                <!-- Team Profile Start -->

                                @if(!empty($private_class[0]))
                                    @if($private_class[0]->available_slots == 0)
                                        <div class="group_class">
                                            <div class="image-text">
                                                <h2>Group Class is no longer Available</h2>
                                            </div>
                                        </div>
                                    @else
                                        <div class="group_class">
                                            <div class="image-text">
                                                <h3 class="number">{{$private_class[0]->title}}</h3>
                                                <p>{!! $private_class[0]->description !!}</p>

                                                <h4>Price : ₦{{ number_format($private_class[0]->price)}}</h4>

                                                <a href="{{ url('user/apply/booking/group/lesson/pay?teacher_id='.$identity.'&slot='.$private_class[0]->slot.'&id='.$private_class[0]->id) }}"
                                                   style="margin-top: 0px !important;background: #e1ac4b;color: #ffffff;padding: 8px;border-radius:6px;"
                                                   class="ml-2">
                                                    <strong>Book Now</strong>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                    <!-- Team Profile End -->
                            </div>

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
