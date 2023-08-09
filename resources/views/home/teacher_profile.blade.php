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
                                                    <img src="{{asset('profile/photo/'.$row->id.'/'.$row->profile_image)}}" class="img-avatar" alt="author" style="width: 80px">
                                                </div>
                                            @else
                                                <div class="figure mb-3">
                                                    <img src="{{asset('avater2.png')}}" class="img-avatar" alt="author">
                                                </div>
                                            @endif

                                        </div>
                                        <div class="profile-content">
                                            <h5 class="name"><a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}}</a> </h5>

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
                                    <br />
                                </div>
                            </div>

                            <div class="col-lg-10">
                                <!-- Team Profile Start -->
                                <div class="team-profile text-center">
                                    <div id="calendar"></div>
                                </div>
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
