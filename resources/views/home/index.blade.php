@extends('home.template')
@section('content')

    @php
    use App\Services\home\HomeService;
    @endphp


  <!-- Hero Start -->
  <div class="upstudy-hero-section section" style="background-color: #FACB27">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6">
                  <!-- Hero Content Start -->
                  <div class="hero-content">
                      <span class="title-speak">START SPEAKING <br />
                          <span class="title" id="word"> <i>YORUBA</i>  </span> IN 2 WEEKS </span>
                     <br />
                      <ul class="list-none space-y-1 font-medium text-sm text-gray2 mt-7">
                          <li class="flex items-center" style="display:flex; margin-right: 5px;">
                              <img src="{{asset("logo-black.png")}}" style="width: 15px; height: 18px;margin-top: 8px; margin-right: 10px;" >
                              <span>Learn from Influencers, Celebrities and Peers</span>
                          </li>
                          <li class="flex items-center" style="display:flex; margin-right: 5px;">
                              <img src="{{asset("logo-black.png")}}" style="width: 15px; height: 18px;margin-top: 8px; margin-right: 10px;" >
                              <span>Flexible scheduling with private and group sessions</span></li>
                          <li class="flex items-center" style="display:flex; margin-right: 5px;">
                              <img src="{{asset("logo-black.png")}}" style="width: 15px; height: 18px;margin-top: 8px; margin-right: 10px;" >
                              <span>Learn only topics you want</span></li>
                          <li class="flex items-center" style="display:flex; margin-right: 5px;">
                              <img src="{{asset("logo-black.png")}}" style="width: 15px; height: 18px;margin-top: 8px; margin-right: 10px;" >
                              <span>Pay as you go</span></li>
                      </ul>

                      <div class="hero-btn">
                          <a class="btn" href="{{url('register')}}" style="background-color: #000000 !important;">START NOW </a>
                      </div>
                  </div>
                  <!-- Hero Content End -->
              </div>
              <div class="col-lg-6">
                  <!-- Hero Images Start -->
                  <div class="hero-images">
                      <div class="image">
                          <img src="{{asset("banners/image1.png")}}" alt="">
                          <div class="image-content text-center">
                              <img src="{{asset("home/img/student-img.png")}}" alt="">
                              <div class="image-text">
                                  <h3 class="number">3k+</h3>
                                  <p>Total Enrolled Students</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Hero Images End -->
              </div>
          </div>
      </div>

  </div>
  <!-- Hero End -->



  <!-- Category Start -->
  <div class="section upstudy-category-section">
      <div class="container">
          <div class="category-wrap">
              <div class="row">
                  <div class="section-title text-center">
                      <br />
                      <h2 class="title">I’m learning language for </h2>
                  </div>
              </div>
              <div class="category-content-wrap">
                  <div class="row justify-content-md-center text-center">
                      @foreach($use_cases as $row)
                          <div class="col-xl-3 col-lg-4 col-sm-6">
                              <!-- Category Item Start -->
                              <a href="{{url('theme?link='.$row->url)}}" class="category-item category-item-ex">
                                  <div class="category-content">
                                      <h3 class="title">{{$row->title}}</h3>
                                  </div>
                              </a>
                              <!-- Category Item End -->
                          </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Category End -->

  <!-- Courses Start -->
  <div class="section section-padding">
      <div class="container">

          <!-- Course Header Start -->
          <div class="course-header">
              <!-- Section Title Start -->
              <div class="section-title">
                  <h2 class="title"><span>Latest</span> Courses</h2>
              </div>
              <!-- Section Title End -->

              <div class="tab-menu">
                  <ul class="nav justify-content-center justify-content-lg-start">
                      <?php $x = 1;?>
                      @foreach($use_cases_course as $row)
                          <?php $number = $x++;?>
{{--                            <li><button class="active" data-bs-toggle="tab" data-bs-target="#tab1">Javascript</button></li>--}}
                          <li><button data-bs-toggle="tab" data-bs-target="#tab{{$number}}" class="{{$number == 1 ? "active" : ""}}">{{$row->title}}</button></li>
                      @endforeach
                  </ul>
              </div>
          </div>
          <!-- Course Header End -->

          <!-- Courses Wrapper Start -->
          <div class="courses-wrapper">

              <!-- Courses Tab Start -->
              <div class="courses-tab">

                  <!-- Courses Tab Content Start -->
                  <div class="tab-content courses-tab-content">

                      <?php $x_ = 1;?>
                      @foreach($use_cases_course as $use_cases)
                              <?php $number = $x_++;?>
                          <div class="tab-pane fade show {{$number == 1 ? "active" : ""}}" id="tab{{$number}}">

                              <div class="row">
                                  @foreach((new HomeService)->getCourseByUseCases($use_cases->id) as $row)
                                      <div class="col-lg-3 col-sm-6">
                                          @include('home.course_list')
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                      @endforeach
                  </div>
                  <!-- Courses Tab Content End -->

              </div>
              <!-- Courses Tab End -->

          </div>
          <!-- Courses Wrapper End -->
      </div>
  </div>
  <!-- Courses End -->

  <div class="section upstudy-team-section section-padding">

      <div class="container">

          <!-- Team Wrapper Start -->
          <div class="team-wrap">

              <div class="row justify-content-center">
                  <div class="col-lg-7">
                      <!-- Section Title Start -->
                      <div class="section-title-2 text-center">
                          <h2 class="title">Meet Our Tutors</h2>
                      </div>
                      <!-- Section Title End -->
                  </div>
              </div>

              <div class="team-content-wrap">
                  <div class="row justify-content-md-center">
                      @foreach($expert_teachers as $row)
                      <div class="col-lg-3 col-sm-6">
                          <!-- Single Team Start -->
                          <div class="single-team text-center">
                              <div class="team-img">
                                  <a href="{{url('teacher/'.$row->identity)}}"> @if(!empty($row->profile_image))
                                      <img src="{{asset('profile/photo/'.$row->id.'/'.$row->profile_image)}}" alt="author" style="width: 100px;height: 100px;">
                                  @else
                                      <img src="{{asset('avater2.png')}}" alt="author" style="width: 100px">
                                      @endif
                                  </a>
                              </div>
                              <div class="team-content">
                                  <h3 class="name"><a href="{{url('teacher/'.$row->identity)}}">{{$row->firstname. ' '.$row->lastname}}</a></h3>
                                  <p class="designation">Tutors - {{$row->lang}}</p>
                              </div>
                          </div>
                          <!-- Single Team End -->
                      </div>
                      @endforeach
                  </div>
              </div>

          </div>
          <!-- Team Wrapper End -->


      </div>
  </div>

  <!-- Counter Start -->
  <div class="section upstudy-counter-section section-padding-02" style="background-color:#FACB27; ">
      <div class="container">
          <div class="counter-wrap">
              <div class="row">
                  <div class="col-lg-3 col-sm-6">
                      <!-- Single Counter Start -->
                      <div class="single-counter text-center">
                          <div class="counter-icon">
                              <img src="{{asset("home/assets/images/counter-1.png")}}" alt="">
                          </div>
                          <div class="counter-content">
                              <h3 class="title">
                                  <sapn class="counter">3</sapn>k+
                              </h3>
                              <p>Total student signups</p>
                          </div>
                      </div>
                      <!-- Single Counter End -->
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <!-- Single Counter Start -->
                      <div class="single-counter text-center">
                          <div class="counter-icon">
                              <img src="{{asset("home/assets/images/counter-2.png")}}" alt="">
                          </div>
                          <div class="counter-content">
                              <h3 class="title">
                                  <sapn class="counter">100</sapn>+
                              </h3>
                              <p>Total video lessons</p>
                          </div>
                      </div>
                      <!-- Single Counter End -->
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <!-- Single Counter Start -->
                      <div class="single-counter text-center">
                          <div class="counter-icon">
                              <img src="{{asset("home/assets/images/counter-1.png")}}" alt="">
                          </div>
                          <div class="counter-content">
                              <h3 class="title">
                                  <sapn class="counter">500</sapn>+
                              </h3>
                              <p>Total group sessions</p>
                          </div>
                      </div>
                      <!-- Single Counter End -->
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <!-- Single Counter Start -->
                      <div class="single-counter text-center">
                          <div class="counter-icon">
                              <img src="{{asset("home/assets/images/counter-4.png")}}" alt="">
                          </div>
                          <div class="counter-content">
                              <h3 class="title">
                                  <sapn class="counter">100</sapn>+
                              </h3>
                              <p>Customized private sessions</p>
                          </div>
                      </div>
                      <!-- Single Counter End -->
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Counter End -->

  <!-- Testimonial Start -->
  <div class="section upstudy-testimonial-section section-padding">
      <div class="container">
          <!-- Testimonial Wrap Start -->
          <div class="testimonial-wrap" style="background-color:#FACB27; ">

              <!-- Testimonial Content Start -->
              <div class="testimonial-content testimonial-content-active">
                  <div class="swiper-container">
                      <div class="swiper-wrapper">
                          <div class="swiper-slide single-testimonial-content">

                              <h3 class="title">Learn From Influencers, Celebrities And Peers</h3>
                              <p>Speakede helps you learn from peers as well as from icons you already know and love</p>
                              <div class="hero-btn">
                                  <a class="btn" href="{{url('register')}}" style="background-color: #000000 !important;">START NOW </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Testimonial Content End -->

              <!-- Testimonial Author Start -->
              <div class="testimonial-author">
                  <div  class="testimonial-author-image"></div>
              </div>
              <!-- Testimonial Author End -->

          </div>
          <!-- Testimonial Wrap End -->
      </div>
  <br />    <br />    <br />
  </div>
  <!-- Testimonial End -->





@endsection
